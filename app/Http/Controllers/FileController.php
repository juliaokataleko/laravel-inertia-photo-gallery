<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Ramsey\Uuid\Uuid;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return Inertia::render("Files/Index", [
            "files" => $files
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Files/NewFile");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
        ]);

        $data['url'] = "url";
        $data['uuid'] = Uuid::uuid4();
        $data['user_id'] = auth()->id();

        $file = File::create($data);

        $this->uploadPhoto($file);

        return redirect()->route('files.index')->with('message', 'Ficheiro enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::findOrFail($id);
        return Inertia::render('Files/ShowFile', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::findOrFail($id);
        return Inertia::render('Files/EditFile', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = File::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string',
        ]);

        $file->update($data);
        return redirect()->route('files.index')->with('message', 'Ficheiro atualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        $path = "uploads/files";
        if (!null == $file->url && file_exists("$path/" . $file->url)) {
            if (unlink("$path/" . $file->url)) {
            }
        }
        $file->delete();
        sleep(1);

        return redirect()->route('files.index')->with('message', 'Ficheiro excluído');
    }

    private function uploadPhoto($file)
    {
        if (isset($_FILES['url']) && !empty($_FILES['url']['tmp_name'])) {

            // update image
            $path = "uploads/files";

            $permitidos = array(
                'image/jpeg', 'image/jpg', 'image/png'
            );

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (in_array($_FILES['url']['type'], $permitidos)) {
                $nome = time() . rand(0, 9999) . '.jpg';

                if (!null == $file->url && file_exists("$path/" . $file->url)) {
                    if (unlink("$path/" . $file->url)) {
                    }
                }

                if (move_uploaded_file($_FILES['url']['tmp_name'], "$path/" . $nome)) {
                    $file->update([
                        'url' => $nome
                    ]);
                }
            }
        }

    }

}
