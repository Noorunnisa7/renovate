<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Your login form here -->
<style>
    .form {
	 background:#fff;
	 padding: 30px;
	 max-width: 500px;
	 width:500px;
	 /* margin: 40px auto; */
	 border-radius: 10px;
	 box-shadow: 0 4px 10px 4px rgba(19, 35, 47, .3);
	 position: absolute;
	 top:50%;
	 left:50%;
	 transform:translate(-50%,-50%);
}
 .tab-group {
	 list-style: none;
	 padding: 0;
	 margin: 0 0 40px 0;
}
 .tab-group:after {
	 content: "";
	 display: table;
	 clear: both;
}
 .tab-group li a {
	 display: block;
	 text-decoration: none;
	 padding: 15px;
	 background: rgba(160, 179, 176, .25);
	 color: #0059a3;
	 font-size: 20px;
	 float: left;
	 width: 50%;
	 text-align: center;
	 cursor: pointer;
	 transition: 0.5s ease;
}
 .tab-group li a:hover {
	 background: #179b77;
	 color: #fff;
}
 .tab-group .active a {
	 background: #0059a3 ;
	 color: #fff;
}
 /* .tab-content > div:last-child {
	 display: none;
} */
 h1 {
	 text-align: center;
	 color: #000;
	 font-weight: 500;
	 margin: 0 0 40px;
	 text-shadow:1px 1px 5px #0059a3;
}
 label {
	 color:#000;
	 transition: all 0.25s ease;
	 -webkit-backface-visibility: hidden;
	 pointer-events: none;
	 font-size: 22px;
}
 label .req {
	 margin: 2px;
	 color: #0059a3 ;
}
 label.active {
	 transform: translateY(50px);
	 left: 2px;
	 font-size: 14px;
}
 label.active .req {
	 opacity: 0;
}
 label.highlight {
	 color: #fff;
}
 input, textarea {
	 font-size: 22px;
	 display: block;
	 width: 100%;
	 padding: 5px 10px;
	 background: none;
	 background-image: none;
	 /* border: 1px solid #a0b3b0; */
	 border:none !important;
	border-bottom:1px solid #0059a3 !important;

	 color: #fff;
	 border-radius: 0px !important;
	 transition: border-color 0.25s ease, box-shadow 0.25s ease;
}
 input:focus, textarea:focus {
	 outline: 0;
	 border-color: #0059a3 ;
	 box-shadow:none !important;
}
 textarea {
	 border: 2px solid #a0b3b0;
	 resize: vertical;
}
 .field-wrap {
	 position: relative;
	 margin-bottom: 40px;
}
 .top-row:after {
	 content: "";
	 display: table;
	 clear: both;
}
 .top-row > div {
	 float: left;
	 width: 48%;
	 margin-right: 4%;
}
 .top-row > div:last-child {
	 margin: 0;
}
 .button {
	 border: 0;
	 outline: none;
	 border-radius: 0;
	 padding: 10px 0;
	 font-size: 1rem;
	 font-weight: 600;
	 text-transform: uppercase;
	 letter-spacing: 0.1em;
	 background: #0059a3 ;
	 color: #fff;
	 transition: all 0.5s ease;
	 -webkit-appearance: none;
}
 .button:hover, .button:focus {
	 background: #0059a3;
}
 .button-block {
	 display: block;
	 width: 100%;
}
 .forgot {
	 margin-top: -20px;
	 text-align: right;
}
 .login_bg{
	background-image:url(https://renovate.pk/wp-content/uploads/2024/10/banner-sofas-4.jpg);
	position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-size: cover;

 }
 .login_bg::before{
	background:#000;
	content:"";
	position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
	opacity:50%;
 }
</style>

<div class="login_bg">
	<div class="form">
		<div class="tab-content"> 
			<div id="login">   
			<h1>Admin Login</h1>
			
			<form action="{{ route('login') }}" method="POST">
				@csrf
				<div class="field-wrap">
				<label>
				Email Address<span class="req">*</span>
				</label>
				<input type="email" name="email" placeholder="Email" class="form-control" required>
			</div>
			
			<div class="field-wrap">
				<label>
				Password<span class="req">*</span>
				</label>
				<input type="password" name="password" placeholder="Password" class="form-control" required>
			</div>
			
			<p class="forgot"><a href="#">Forgot Password?</a></p>
			
			<button class="button button-block">Log In</button>
			
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
			
		</div><!-- tab-content -->
		
	</div> <!-- /form -->

</div>
