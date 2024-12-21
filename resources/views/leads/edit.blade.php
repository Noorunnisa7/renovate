

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
            <h1>Admin Edit</span></h1>
            </div>
            
            <form action="{{ route('edit') }}" method="POST">
              @csrf
            <div class="row">
               
        
        <div class="col-6 mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="fname" placeholder="Enter your first name" required>
        </div>
        <div class="col-6 mb-3">
          <label for="name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="name" name="lname" placeholder="Enter your last name" required>
      </div>
        <div class="col-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="col-6 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"
                required>
        </div>
        <div class="col-4 mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone"
              required>
      </div>
      <div class="col-4 mb-3">
        <label for="shares" class="form-label">Number of Shares</label>
        <input type="shares" class="form-control" id="shares" name="shares" placeholder="Enter your shares"
            required>
      </div>
        <div class="col-4 mb-3">
            <label for="role" class="form-label">Access</label>
            <select class="form-select" id="role" name="role" required>
              <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="agent">Agent</option>
                <option value="supervisor">Supervisor</option>
            </select>
        </div>
        <div class="col-12 mb-3">
          <label for="shares" class="form-label">Address</label>
          <textarea name="address" class="form-control" id="address" cols="30" rows="5" placeholder="Enter your Address"></textarea>
        </div>
       <div class="col-12">
        <button type="submit" class="btn btn-primary">Register</button>
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