<?php

namespace App\Services\v1;

use Validator;
use App\Team;

class TeamService {
    
    public function getTeams(){
        
        return $this->filterTeams(Team::all());
        
    }
    
    public function getTeam($teamName){
        
        return $this->filterTeams(Team::where('teamName', $teamName)->get());
    }
    
    public function createTeam($request) {
 
        $team = new Team();
        $team->employee_id  = $request->input('employee_id');
        $team->teamName     = $request->input('teamName');
        
        $team->save();
        
        return $this->filterTeams([$team]);
    }
    
     public function updateTeam($request, $teamName) {
        
        $team = Team::where('teamName', $teamName)->firstOrFail();

        $team->teamName     = $request->input('teamName');
        
        $team->save();
        return $this->filterTeams([$team]);
    }
    
    public function deleteTeam($teamName) {
        $team = Team::where('teamName', $teamName)->firstOrFail();
        
        $team->delete();
    }
    
    //Filtering data output, by not showing id, created_at and updated_at
    
    protected function filterTeams($teams){

        $data = [];
        
        foreach($teams as $team){
            
            $entry = [
                'teamName'  => $team->teamName,
                'href'      => route('teams.show', ['id' => $team->teamName])
            ];
            
            $data[] = $entry;            
        }
     
        return array_unique($data, SORT_REGULAR);   //sorting array to remove all duplicates
    }
    
     //Validating process. Making input to be required.
    
    protected $rules = [
        'employee_id'   => 'required|numeric',      ////numeric, validate that it is an integer.
        'teamName'      => 'required',
    ];
    public function validate($team) {
        $validator = Validator::make($team, $this->rules);
        $validator->validate();
    }
}
