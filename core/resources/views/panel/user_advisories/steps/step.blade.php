@push('head')
	<link href=
'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>

	<script src=
'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
	</script>


	<link rel="stylesheet" href="styles.css">
</head>
<style>

#form {
	text-align: center;
	position: relative;
	margin-top: 20px
}

.text {
	color: #2F8D46;
	font-weight: normal
}

#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	color: lightgrey;
    padding:0
}

#progressbar .active {
	color: #2F8D46
}

#progressbar li {
	list-style-type: none;
	font-size: 15px;
	width: 25%;
	float: left;
	position: relative;
    cursor: pointer;
}

#progressbar #step1:before {
	content: "1";
	font-size: 15px;
	line-height: 2.6;
}

#progressbar #step2:before {
	content: "2";
	font-size: 15px;
	line-height: 2.6;
}

#progressbar #step3:before {
	content: "3";
	font-size: 15px;
	line-height: 2.6;
}

#progressbar #step4:before {
	content: "4";
	font-size: 15px;
	line-height: 2.6;
}
#progressbar #step5:before {
	content: "5";
	font-size: 15px;
	line-height: 2.6;
}

#progressbar li:before {
	width: 40px;
	height: 40px;
	line-height: 45px;
	display: block;
	font-size: 20px;
	color: #ffffff;
	background: lightgray;
	border-radius: 50%;
	margin: 0 auto 10px auto;
	padding: 2px
}

#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: lightgray;
	position: absolute;
	left: 0;
	top: 25px;
	z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
	background: #2F8D46
}

.progress {
	height: 20px
}

.progress-bar {
	background-color: #2F8D46
}

</style>
@endpush

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-11 col-sm-9 col-md-7
				col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
				<div class="px-0  pb-0  mb-3">
					<form id="form" class="m-0">
						<ul id="progressbar" class="d-flex">
							<li class="active" id="step1" data-li="1">
								Profile
							</li>
							<li id="step2" data-li="2">Balance</li>
							<li id="step3" data-li="3">Goals</li>
							<li id="step4" data-li="4">Budget</li> 
                            <li id="step5" data-li="5">Risk score</li>  
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>


