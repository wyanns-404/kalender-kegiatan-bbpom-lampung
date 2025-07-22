<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    
    public function getPublicAgendas()
    {
        $agenda = Agenda::select('uuid', 'title', 'start', 'end', 'allDay', 'backgroundColor', 'tempat', 'pic')
            ->where('visibility', '1')
            ->get();
        return response()->json($agenda);
    }

    public function getStaffAgendas()
    {
        $agenda = Agenda::select('uuid', 'title', 'start', 'end', 'allDay', 'backgroundColor', 'tempat', 'pic', 'private_content')
            ->where('visibility', '1')
            ->get();
        return response()->json($agenda);
    }
}
