<x-master-layout>
    @section('title')
    <h2>Companies</h2>
    @endsection

    <div class="card card-flush mt-6 mt-xl-9">
        <div class="card-header mt-5">
            <div class="card-title flex-column">
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{route('admin.company.create')}}" class="btn" style="background-color: rgba(251,98,64,255); color: white;">Add New Company</a>
                </div>
            </div>
            <div class="card-toolbar my-1">
                
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" id="kt_filter_search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Order" />
                </div>
            </div>
        </div>
        <br>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                        <tr>
                            <th class="min-w-250px">Name</th>
                            <th class="min-w-150px">Email</th>
                            <th class="min-w-90px">Website</th>
                            <th class="min-w-50px text-start">Action</th>
                        </tr>
                    </thead>
                    <tbody class="fs-6">
                        @foreach($companies as $company)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-5 position-relative">
                                        <div class="symbol symbol-35px symbol-label">
                                            <img src="{{ asset('storage/images/'. $company->logo) }}">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        {{$company->name}}
                                    </div>
                                </div>
                            </td>
                            <td>{{$company->email}}</td>
                            <td>
                                <a href="{{$company->website_link}}" target="__blank">{{$company->website_link}}</a>
                            </td>
                            <td class="text-start">
                                <a href='{{route('admin.company.edit', $company->id)}}' class='text-dark '>Edit</a>
                                <a href='{{route('admin.company.destroy', ['company' => $company->id])}}' style='color: rgba(251,98,64,255);' onclick="confirm('Are you sure you want to delete this company information?') || event.stopImmediatePropagation()">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @push('script')
    <script src="{{ asset('assets/js/custom/apps/projects/project/company.js')}}"></script>
    @endpush
</x-master-layout>