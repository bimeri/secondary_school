<?php

namespace App\Http\Controllers;

use App\Background;
use App\Permission;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:admin');
    }

    public function create(){
        $this->authorize('create_sector', Permission::class);

        return view('admin.public.sector.createSector');
    }

    public function createBackround(){
        $this->authorize('create_backgorund', Permission::class);

        return view('admin.public.sector.createBackground');
    }

    public function viewBackground(){
        $this->authorize('see_background', Permission::class);

        return view('admin.public.sector.viewBackground');
    }

    public function viewSector(){
        $this->authorize('see_sector', Permission::class);

        return view('admin.public.sector.viewSector');
    }

    public function updateSector(Request $req){
        $this->authorize('create_sector', Permission::class);

        $this->validate($req, [
            'sectorId' => 'required',
            'sector' => 'required',
            'describe' => 'required',
        ]);
            $sectorid = $req['sectorId'];
            $sectorName = $req['sector'];
            $sectordescribe = $req['describe'];

            $updatesector = DB::table('sectors')->where('id', $sectorid)->update([
                'name' => $sectorName,
                'description' => $sectordescribe,
            ]);

            if($updatesector){
                $notification = array(
                    'message' => 'sector updates was successful!',
                    'alert-type' => 'success');
                return redirect()->back()->with($notification);
            }
            else{
                $notification = array(
                    'message' => 'Nothing changed. please try again!',
                    'alert-type' => 'info' );
                return redirect()->back()->with($notification);
            }
            return redirect()->back()->withInput();
    }

    public function updateBackground(Request $req){
        $this->authorize('create_backgorund', Permission::class);

        $this->validate($req, [
            'backgroundName' => 'required',
            'sid' => 'required',
            'background' => 'required',
        ]);
            $bgid = $req['backgroundName'];
            $sectorName = $req['sid'];
            $bgdname = $req['background'];

            //return [$bgid, $sectorName, $bgdname];

            $updatebg = DB::table('backgrounds')->where('id', $bgid)->update([
                'name' => $bgdname,
                'sector_id' => $sectorName,
            ]);

            if($updatebg){
                $notification = array(
                    'message' => 'background updates was successful!',
                    'alert-type' => 'success');
                return redirect()->back()->with($notification);
            }
            else{
                $notification = array(
                    'message' => 'Nothing changed. please try again!',
                    'alert-type' => 'info' );
                return redirect()->back()->with($notification);
            }
            return redirect()->back()->withInput();
    }

    public function createSector(Request $req){
        $this->authorize('create_sector', Permission::class);
        $this->validate($req, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $sector_name = $req['name'];
        $sector_describe = $req['description'];

        $sector = new Sector();
        $sector->name = $sector_name;
        $sector->description = $sector_describe;
        $sector->save();

        if($sector){
            $notification = array(
                'message' => 'the Sector named '.$sector_name.' has been saved successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else {
            $notification = array(
                'message' => 'Fail to save Sector. please try agian!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        return redirect()->back()->withInput();
    }

    public function createBackground(Request $req){
        $this->authorize('create_backgorund', Permission::class);
        $this->validate($req, [
            'sectorName' => 'required',
            'background' => 'required',
        ]);

        $sector_id = $req['sectorName'];
        $bg_name = $req['background'];

        $backgorund = new Background();
        $backgorund->sector_id = $sector_id;
        $backgorund->name = $bg_name;

        $backgorund->save();

        if($backgorund){
            $notification = array(
                'message' => 'the Background name '.$bg_name.' has been saved successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else {
            $notification = array(
                'message' => 'Fail to save Background. please try agian!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        return redirect()->back()->withInput();
    }

    public function deleteSector(Request $req){
        $id = $req['sectorid'];

        DB::table('sectors')->where('id', $id)->delete();
        $notification = array('message' => 'Sector deleted successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }

    public function deleteBackground(Request $req){
        $id = $req['backgroundName'];

        DB::table('backgrounds')->where('id', $id)->delete();
        $notification = array('message' => 'Background deleted successfully', 'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }
}
