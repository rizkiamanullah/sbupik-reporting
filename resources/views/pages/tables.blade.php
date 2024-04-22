@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Projects table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Task</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Priority</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Completion</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-spotify.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SCI Kemitraan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Maintenance</p>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input class="me-2 text-xs font-weight-bold form-control" type="text" id="progress" style="width: 50px">
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress progress-striped active">             
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">             
                                                              <span class="sr-only">100%</span>             
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-invision.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="invision">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SCI Kemitraan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Maintenance</p>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><span class="badge bg-warning">Middle priority</span></h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input class="me-2 text-xs font-weight-bold form-control" type="text" id="progress" style="width: 50px">
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress progress-striped active">             
                                                            <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">             
                                                              <span class="sr-only">100%</span>             
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-jira.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SCI Kemitraan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Maintenance</p>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input class="me-2 text-xs font-weight-bold form-control" type="text" id="progress" style="width: 50px">
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress progress-striped active">             
                                                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">             
                                                              <span class="sr-only">100%</span>             
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-slack.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="slack">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SCI Kemitraan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Maintenance</p>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input class="me-2 text-xs font-weight-bold form-control" type="text" id="progress" style="width: 50px">
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress progress-striped active">             
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">             
                                                              <span class="sr-only">100%</span>             
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-webdev.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SCI Kemitraan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Maintenance</p>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input class="me-2 text-xs font-weight-bold form-control" type="text" id="progress" style="width: 50px">
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress progress-striped active">             
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">             
                                                              <span class="sr-only">100%</span>             
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-xd.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">SCI Kemitraan</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">Maintenance</p>
                                        </td>
                                        <td class="align-middle">
                                            <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input class="me-2 text-xs font-weight-bold form-control" type="text" id="progress" style="width: 50px">
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress progress-striped active">             
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">             
                                                              <span class="sr-only">100%</span>             
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-link text-secondary mb-0" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer text-end p-3">
                                <button class="me-2 btn btn-link">Cancel</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Task</button>

                                <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <b>To-Do List</b>
                                                                </div>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control" name="" id="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset class="form-group">
                                                            <div class="row">
                                                                <legend class="col-form-label col-4 pt-0">Priority</legend>
                                                                <div class="col-8">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <h6 class="badge bg-danger"><span class="" style="text-align: right">High priority</span></h6>
                                                                                {{-- <label class="form-check-label" for="gridRadios1" class="badge bg-danger">
                                                                                    High priority
                                                                                 </label> --}}
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <h6 class="badge bg-warning" style="text-align: left">Middle priority</h6>
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="mb-0"><i class="fas fa-tasks me-2"></i>Contributors</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                      <th scope="col">Team Member</th>
                                      <th scope="col">Task</th>
                                      <th scope="col">Priority</th>
                                      <th scope="col">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr class="fw-normal">
                                      <th>
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp"
                                          class="shadow-1-strong rounded-circle" alt="avatar 1"
                                          style="width: 55px; height: auto;">
                                        <span class="ms-2">Alice Mayer</span>
                                      </th>
                                      <td class="align-middle">
                                        <span>Call Sam For payments</span>
                                      </td>
                                      <td class="align-middle">
                                        <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                                      </td>
                                      <td class="align-middle">
                                        <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                            class="fas fa-check text-success me-3"></i></a>
                                        <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                            class="fas fa-trash-alt text-danger"></i></a>
                                      </td>
                                    </tr>
                                    <tr class="fw-normal">
                                      <th>
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-4.webp"
                                          class="shadow-1-strong rounded-circle" alt="avatar 1"
                                          style="width: 55px; height: auto;">
                                        <span class="ms-2">Kate Moss</span>
                                      </th>
                                      <td class="align-middle">Make payment to Bluedart</td>
                                      <td class="align-middle">
                                        <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                                      </td>
                                      <td class="align-middle">
                                        <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                            class="fas fa-check text-success me-3"></i></a>
                                        <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                            class="fas fa-trash-alt text-danger"></i></a>
                                      </td>
                                    </tr>
                                    <tr class="fw-normal">
                                      <th>
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                          class="shadow-1-strong rounded-circle" alt="avatar 1"
                                          style="width: 55px; height: auto;">
                                        <span class="ms-2">Danny McChain</span>
                                      </th>
                                      <td class="align-middle">Office rent</td>
                                      <td class="align-middle">
                                        <h6 class="mb-0"><span class="badge bg-warning">Middle priority</span></h6>
                                      </td>
                                      <td class="align-middle">
                                        <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                            class="fas fa-check text-success me-3"></i></a>
                                        <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                            class="fas fa-trash-alt text-danger"></i></a>
                                      </td>
                                    </tr>
                                    <tr class="fw-normal">
                                      <th>
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-3.webp"
                                          class="shadow-1-strong rounded-circle" alt="avatar 1"
                                          style="width: 55px; height: auto;">
                                        <span class="ms-2">Alexa Chung</span>
                                      </th>
                                      <td class="align-middle">Office grocery shopping</td>
                                      <td class="align-middle">
                                        <h6 class="mb-0"><span class="badge bg-danger">High priority</span></h6>
                                      </td>
                                      <td class="align-middle">
                                        <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                            class="fas fa-check text-success me-3"></i></a>
                                        <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                            class="fas fa-trash-alt text-danger"></i></a>
                                      </td>
                                    </tr>
                                    <tr class="fw-normal">
                                      <th class="">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp"
                                          class="shadow-1-strong rounded-circle" alt="avatar 1"
                                          style="width: 55px; height: auto;">
                                        <span class="ms-2">Ben Smith</span>
                                      </th>
                                      <td class="align-middle">Ask for Lunch to Clients</td>
                                      <td class="align-middle">
                                        <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                                      </td>
                                      <td class="align-middle">
                                        <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                            class="fas fa-check text-success me-3"></i></a>
                                        <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                            class="fas fa-trash-alt text-danger"></i></a>
                                      </td>
                                    </tr>
                                    <tr class="fw-normal">
                                      <th class="border-0">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-2.webp"
                                          class="shadow-1-strong rounded-circle" alt="avatar 1"
                                          style="width: 55px; height: auto;">
                                        <span class="ms-2">Annie Hall</span>
                                      </th>
                                      <td class="border-0 align-middle">Create weekly tasks plan</td>
                                      <td class="border-0 align-middle">
                                        <h6 class="mb-0"><span class="badge bg-warning">Medium priority</span></h6>
                                      </td>
                                      <td class="border-0 align-middle">
                                        <a href="#!" data-mdb-toggle="tooltip" title="Done"><i
                                            class="fas fa-check text-success me-3"></i></a>
                                        <a href="#!" data-mdb-toggle="tooltip" title="Remove"><i
                                            class="fas fa-trash-alt text-warning"></i></a>
                                      </td>
                                    </tr>
                                  </tbody>
                            </table>
                            <div class="card-footer text-end p-3">
                                <button class="me-2 btn btn-link">Cancel</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Task</button>

                                <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <div class="row">
                                                            <div class="col-2">
                                                                <b>To-Do List</b>
                                                            </div>
                                                            <div class="col-10">
                                                                <input type="text" class="form-control" name="" id="">
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <fieldset class="form-group">
                                                            <div class="row">
                                                                <legend class="col-form-label col-2 pt-0">Radios</legend>
                                                                <div class="col-10">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <h6 class="badge bg-danger"><span class="" style="text-align: right">High priority</span></h6>
                                                                                {{-- <label class="form-check-label" for="gridRadios1" class="badge bg-danger">
                                                                                    High priority
                                                                                 </label> --}}
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <h6 class="badge bg-warning" style="text-align: left">Middle priority</h6>
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                                                        <div class="row">
                                                                            <div class="col-5">
                                                                                <h6 class="mb-0"><span class="badge bg-success">Low priority</span></h6>
                                                                            </div>
                                                                        </div>    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="mb-0"><i class="fas fa-tasks me-2"></i>Task List</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="days">
                            @php
                                $warna = ["#288540", "#30A14E","#40C463"," #9AE9A8", "#FFF"];    
                            @endphp
                            @for ($i = 1; $i < 365 ; $i++)
                            <div class="day" style="background-color: {{$warna[rand(0,4)]}}"></div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    <script>
        $(document).delegate('#progress','keyup',function(){
            var progress_bar = $(this).parent().find('.progress-bar');
            progress_bar.css('width', $(this).val()+"%");
        })
    </script>
    {{-- <script type="text/javascript">
        var inputProgress = document.getElementById('progress');
        var ProgressBar = document.getElementsByClassName('progress-bar');
        inputProgress.onkeyup = function(e){
            ProgressBar[0].style.width = inputProgress.value+'%';
        };
    </script> --}}
@endsection



