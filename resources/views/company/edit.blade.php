<x-master-layout>
    <div class="card">
        <div class="card-body">
            <div class="row g-9 mb-8">
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Edit Company</span>
                            <span class="text-muted mt-1 fw-bold fs-7">COMPANY INFORMATION</span>
                        </h3>
                        <div class="card-toolbar">
                            <form action="{{route('admin.company.update', ['company' => $company->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <button type="submit" class="btn" style="background-color: rgba(251,98,64,255); color: white;">Save</button>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-6 fv-row">
                    <label class="required fs-6 fw-bold mb-2">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name' , $company->name) }}">
                </div>
                <div class="col-md-6 fv-row">
                    <label class="fs-6 fw-bold mb-2">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email' , $company->email) }}">
                </div>
                <div class="col-md-6 fv-row">
                    <label class="fs-6 fw-bold mb-2">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    <br>
                    <img src="{{ asset('storage/images/'. $company->logo) }}" style="width: 33%; height: 55%;">
                </div>
                <div class="col-md-6 fv-row">
                    <label class="fs-6 fw-bold mb-2">Website</label>
                    <input type="text" name="website_link" class="form-control" value="{{ old('website_link' , $company->website_link) }}">
                </div>
            </form>
            </div>
        </div>
    </div>
</x-master-layout>