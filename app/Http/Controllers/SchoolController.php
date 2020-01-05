<?php

namespace App\Http\Controllers;

use App\GradeClass;
use App\School;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SchoolController extends Controller
{
    /**
     * Renderiza uma view com todas as escolas que o usuario tem acesso
     * @return Factory|View
     */
    public function index(){
        if( auth()->user()->access_level > 2) {
            $schools = School::all();
        }
        else {
            $schools = School::where('id', auth()->user()->school_id)->get();
        }
        return view('school.show' , compact('schools'));
    }

    /**
     * Cria uma escola
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function store(Request $request){
        $this->authorize('create', School::class);

        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        School::create($validated);
        return redirect("/school");
    }

    /**
     * Atualiza a escola
     * @param Request $request
     * @param School $school
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(Request $request, School $school){
        $this->authorize('update', $school);

        $validated = $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"]
        ]);
        $school->update($validated);
        return redirect("/school");
    }

    /** Deleta a escola
     * @param School $school
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(School $school){
        $this->authorize('delete', $school);
        $school->delete();
        return redirect("/school");
    }

    /**
     * Retorna as classes da escola permitido ao usuario
     * @param int $id
     * @return GradeClass[]
     * @throws AuthorizationException
     */
    public function classes($id) {
        $user = auth()->user();
        $school = School::findOrFail($id);
        $this->authorize('allowShowClasses', $school);
        $gradeClasses = [];
        if($user->access_level > 1) {
            $gradeClasses = $school->gradeClasses;
        }
        else {
            $gradeClasses = $user->classes();
        }
        return $gradeClasses;
    }

    /**
     * Renderiza uma view para editar a escola
     * @param School $school
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(School $school) {
        $this->authorize('update', $school);
        return view('school.edit', compact('school'));
    }

    /**
     * Renderiza uma view para criar escolas
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function create(){
        $this->authorize('create', School::class);
        return view('school.create');
    }

    /**
     * Renderiza uma view para mostrar as classes associadas
     * @param int $id
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function showClasses($id) {
        $gradeClasses = $this->classes($id);
        return view("grade_class.show",compact(['gradeClasses', 'id']));
    }

}
