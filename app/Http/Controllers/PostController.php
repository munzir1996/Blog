<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Session;
use Purifier; 
use Image;
use Storage;

class PostController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		/*
		* Creates a variable and store all the blog posts in the variable
		*@posts
		*/
		$posts = Post::orderBy('id', 'desc')->paginate(5);
		/*
		*Return a view and pass in the above variable
		*@posts
		*/
		return view('posts.index')->withPosts($posts); 
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$tags = Tag::all();
		$categories = Category::all();

		return view('posts.create')->withCategories($categories)->withTags($tags);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//Validate the data
		$this->validate($request, array(
			'title' => 'required|max:255',
			'slug' => 'required|alpha_dash|min:5|max:255',
			'category_id' => 'required|integer',
			'body' => 'required',
			'featured_image' => 'sometimes|image'
			
		));

		$post = new Post;

		$post->title = $request->title;
		$post->slug = $request->slug;
		$post->category_id = $request->category_id;
		$post->body =Purifier::clean($request->body);

		//Save our image
		if($request->hasFile('featured_image')){
			$image = $request->file('featured_image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$location = public_path('images/' . $filename);
			Image::make($image)->resize(800, 400)->save($location);
			
			$post->image = $filename;
		}

		$post->save();
		
		$post->tags()->sync($request->tags, false);

		Session::flash('success', 'The post was successfuly save!');

		//Redirect to another page
		return redirect()->route('posts.show', $post->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);

		return view('posts.show')->withPost($post);
	} 

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Find the post int Database and save it as a @post
		$post = Post::find($id);
		
		$categories = Category::all();
		$cats = [];
		foreach ($categories as $category) {
			$cats[$category->id] = $category->name;
		}

		$tags = Tag::all();
		$tags2 = [];
		foreach ($tags as $tag) {
			$tags2[$tag->id] = $tag->name;
		}

		//Return the view and pass in the @post
		return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$post = Post::find($id);

		//Validate the data

		$this->validate($request, array(
			'title' => 'required|max:255',
			'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
			'category_id' => 'required|integer|max:255',
			'body' => 'required',
			'featured_image' => 'image'
		));

		
		//Saves the data to the database
		$post = Post::find($id);

		$post->title = $request->title;
		$post->title = $request->slug;
		$post->category_id = $request->category_id;
		$post->body =Purifier::clean($request->body);

		if($request->hasFile('featured_image')){
			
			//Add the new photo
			$image = $request->file('featured_image');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$location = public_path('images/' . $filename);
			Image::make($image)->resize(800, 400)->save($location);
			$oldFilename = $post->image;
			
			//Update the database
			$post->image = $filename;

			//Delete the database
			Storage::delete($oldFilename);
		}

		$post->save();

		if (isset($request->tags)) {
			$post->tags()->sync($request->tags);
		} else {
			$post->tags()->sync(array());
		}
		
		//Set flash data with success message
		Session::flash('success', 'This post was successfuly saved.');

		//Redirect with flash data to posts.show
		return redirect()->route('posts.show', $post->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$post = Post::find($id);

		$post->tags()->detach();
		Storage::delete($post->image);
		
		$post->delete();

		Session::flash('success', 'The post was successfuly deleted.');

		return redirect()->route('posts.index');
	}

}
