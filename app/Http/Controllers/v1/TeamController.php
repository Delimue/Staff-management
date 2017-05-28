<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

use App\Services\v1\TeamService;


class TeamController extends Controller
{
    protected $teams;

    public function __construct(TeamService $service) {
        
        $this->teams = $service; 
    }
  
    //show all teams
    public function index()
    {
        $data = $this->teams->getTeams();
        
        return response()->json($data);
    }
    
    //show -> how many are on a specific team
    
    public function show($id)
    {
        $data = $this->teams->getTeam($id);
        
        return response()->json($data);
    }

    //store -> create a new team with associated employee, under employee_id into db
    
    public function store(Request $request)
    {
         $this->teams->validate($request->all());
        
        try {
            $team = $this->teams->createTeam($request);
            return response()->json($team, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

     //update -> update a specific team for an employee
    
    public function update(Request $request, $id)
    {
          $this->teams->validate($request->all());
        
        try {
            $team = $this->teams->updateTeam($request, $id);
            return response()->json($team, 200);
        
        } 
        catch (ModelNotFoundException $ex) {
            throw $ex;
        }
 
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

     //delete -> delete a specific team for an employee
    
    public function destroy($id)
    {
        try {
            $team = $this->teams->deleteTeam($id);
            return response()->make('', 204);
        } 
        catch (ModelNotFoundException $ex) {
            throw $ex;
        }
        catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
