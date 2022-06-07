@extends('backend.layouts.admin')
@section('title', 'Site Ayarları')
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Site Ayarları</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Settings</a></div>

                </div>
            </div>

            <div class="section-body">


                <div id="output-status"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="card-body">
                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Genel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Seo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Sosyal Medya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab" aria-controls="contact" aria-selected="false">Email</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{route('admin.settings.update', [ 'id'=> $data->id ])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card" id="settings-card">

                                <div class="card-body">


                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Mağaza Adı</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="company" value="{{$data->company}}" class="form-control" id="site-title">
                                                    <input type="hidden" name="id" value="{{$data->id}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Telefon Numarası</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="phone" value="{{$data->phone}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Mobile</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="mobile" value="{{$data->mobile}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Fax</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="fax" value="{{$data->fax}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Email</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="email" value="{{$data->email}}" class="form-control" id="site-title">
                                                </div>
                                            </div>


                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Logo</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="file" name="logo" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Favicon</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="file" name="favicon" class="form-control" id="site-title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">

                                            <div class="form-group row align-items-center">
                                                <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Title</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <textarea class="form-control" name="title" id="site-description"> {{$data->title}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Keywords</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <textarea class="form-control" name="keywords" id="site-description">{{$data->keywords}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Description</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <textarea class="form-control" name="description" id="site-description">{{$data->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-control-label col-sm-3 mt-3 text-md-right">Analytics Code</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <textarea class="form-control" name="analytics">{{$data->analytics}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Facebook</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="facebook" value="{{$data->facebook}}" class="form-control" id="site-title">
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">İnstagram</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="instagram" value="{{$data->instagram}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Twitter</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="twitter" value="{{$data->twitter}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Youtube</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="youtube" value="{{$data->youtube}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Linkedin</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="linkedin" value="{{$data->linkedin}}" class="form-control" id="site-title">
                                                </div>
                                            </div>






                                        </div>

                                        <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab5">
                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Smtp Host</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="smtpserver" value="{{$data->smtpserver}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Smtp Email</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="smtpemail" value="{{$data->smtpemail}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Smtp Password</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="password" name="smtppassword" value="{{$data->smtppassword}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <label for="site-title" class="form-control-label col-sm-3 text-md-right">Smtp Port</label>
                                                <div class="col-sm-6 col-md-9">
                                                    <input type="text" name="smtpport" value="{{$data->smtpport}}" class="form-control" id="site-title">
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                </div>
                                <div class="card-footer bg-whitesmoke text-md-right">
                                    <input type="submit" value="Kaydet" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

