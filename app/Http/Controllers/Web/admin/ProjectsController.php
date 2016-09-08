<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Project\AddProjectRequest;
use App\Http\Requests\Requests\Project\DeleteProjectImageRequest;
use App\Http\Requests\Requests\Project\DeleteProjectRequest;
use App\Http\Requests\Requests\Project\GetAllProjectsRequest;
use App\Http\Requests\Requests\Project\GetProjectImagesRequest;
use App\Http\Requests\Requests\Project\GetProjectRequest;
use App\Http\Requests\Requests\Project\UpdateProjectRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\ProjectsRepoProvider;


class ProjectsController extends Controller
{
    public $response = null;
    public $projectRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->projectRepo = (new ProjectsRepoProvider())->repo();
    }
    public function project()
    {
        return $this->response->setView('admin.projects.project')->respond([
        ]);
    }
    public function addProject(AddProjectRequest $request)
    {
        $projectId = $this->projectRepo->addProject($request->getProjectModel());

        if($request->get('images')[0] !=null)
         $this->addProjectImages($request,$projectId);
        return redirect('maliksajidawan786@gmail.com/project/listing');
    }
    public function addProjectImages(AddProjectRequest $request ,$projectId)
    {
        return $this->projectRepo->addImages($request->getProjectImageModel(),$projectId);
    }
    public function getAllProjects(GetAllProjectsRequest $request)
    {
        return $this->response->setView('admin.projects.project-listing')->respond(['data'=>[
            'projects'=>$this->projectRepo->getAllProjects($request->all()),
            'projectCount'=>($this->projectRepo->projectCount()[0]->total_records)
        ]]);
    }
    public function deleteProject(DeleteProjectRequest $request)
    {
        $this->projectRepo->deleteProject($request->get('projectId'));
        return redirect('maliksajidawan786@gmail.com/project/listing');
    }
    public function getProject(GetProjectRequest $request)
    {
        return $this->response->setView('admin.projects.update-project')->respond(['data'=>[
            'project'=>$this->projectRepo->getProject($request->get('projectId')),
         ]]);
    }
    public function updateProject(UpdateProjectRequest $request)
    {
        $this->projectRepo->updateProject($request->getProjectModel());
        if(($request->get('images')[0]) !=null && ($request->get('images')[0]) !="")
            $this->projectRepo->addImages($request->getProjectImageModel(),$request->get('projectId'));
        return redirect('maliksajidawan786@gmail.com/project/listing');
    }
    public function getProjectImages(GetProjectImagesRequest $request)
    {
        return $this->response->setView('admin.projects.images-listing')->respond(['data'=>[
            'projectImage'=>$this->projectRepo->getProjectImages($request->get('projectId'))
        ]]);
    }
    public function deleteProjectImage(DeleteProjectImageRequest $request)
    {
        $this->projectRepo->deleteProjectImage($request->get('imageId'));
        return redirect('maliksajidawan786@gmail.com/get/project/images');
    }
}
