<?php
namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = $user->categories()
        ->withCount('tasks')
        ->latest()
        ->get();

        return view('categories.index', compact('categories'));
    }
  
  public function create( )
    {
      return  view ('categories.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'color' =>'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/'
    ]);

    $user = Auth::user();
    $user->categories()->create($data);

    return redirect()->route('categories.index')->with('success','Категория создана');
}


public function edit (Request $request, Category $category){
    $this -> authorize('update', $category);
    return view('categories.edit', compact('category'));
}

public function update(Request $request, Category $category){

    $this->authorize('update',$category);

    $data = $request->validate([
    'name' => 'required|string|max:255',
    'color' =>'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/'
    ]);

    $category->update($data);
return redirect()->route('categories.index')->with('success','Категория обновлена');
}   

public function destroy(Category $category){
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('categories.index')->with
        ('success', 'Категория удалена');
    }
}