

@include('templates.link')

    <div class="wrapper">
@include('templates.sidebar')

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="../index.html" class="logo">
                <img
                  src="../assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          @include('templates.topbar')
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
            <h1>Leads Create</span></h1>
            </div>
            
            <form action="{{ route('createLead') }}" method="POST">
              @csrf
            <div class="row">
               
        
        <div class="col-4 mb-3">
            <label  class="form-label">Mobile No</label>
            <input type="text" class="form-control" id="mobileNo" name="mobileNo" placeholder="Mobile No" required>
        </div>
        <div class="col-4 mb-3">
          <label for="name" class="form-label">Customer Name</label>
          <input type="text" class="form-control" id="name" name="lname" placeholder="Customer Name" required>
      </div>
        <div class="col-4 mb-3">
            <label for="email" class="form-label">Customer City</label>
            <select name="city" id="city" class="form-select">
                <option value="">Select City</option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4 mb-3">
            <label for="" class="form-label">Select Status</label>
            <select name="status" id="status" class="form-select">
              <option value="">Select Status</option>
              @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->statusName }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4 mb-3">
          <label  class="form-label">Assign lead</label>
          <select name="assign_lead" id="assign_lead" class="form-select">
            <option value="">Select Assign Lead</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
      </div>
      <div class="col-4 mb-3">
        <label  class="form-label">Select Source</label>
        <select name="source" id="source" class="form-select">
            <option value="">Select Source</option>
          @foreach($sources as $source)
            <option value="{{ $source->id }}">{{ $source->name }}</option>
          @endforeach
        </select>
      </div>
        <div class="col-6 mb-3">
            <label for="role" class="form-label">Customer Address</label>
            <textarea name="address" class="form-control" id="address" cols="30" rows="5" placeholder="Customer Address"></textarea>

        </div>
        <div class="col-6 mb-3">
          <label for="shares" class="form-label">Remarks</label>
          <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="5" placeholder="Remarks"></textarea>
        </div>
        <div class="col-12 mb-3">
          <label for="shares" class="form-label">Select Image</label>
          <div class="row">
            <div class="col-6">
              <input type="file" class="form-control">
            </div>
            <div class="col-6">
              <img src="" alt="">
            </div>
          </div>
        </div>
        
       <div class="col-12">
        <button type="submit" class="btn btn-primary">Create Lead</button>
       </div>
   
           
               
             
            </div>
          </form>

          @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
          </div>
        </div>

        @include('templates.footer')
      </div>

    
    </div>
   

@include('templates.script')