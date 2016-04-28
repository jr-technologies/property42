<!DOCTYPE html>
<html>
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Property42</title>
	<!-- include the site stylesheet -->
	<link media="all" rel="stylesheet" href="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/css/main.css">
	<link media="all" rel="stylesheet" href="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/css/select2.css">
	<!-- google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
</head>
<body class="sideBar-active">
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<header id="header">
			<a href="#" class="logo">Property42</a>
			<a href="#" class="sideBar-opener"><span></span></a>
			<a href="#" class="add-property less-indent">Add a property</a>
		</header>
		<main id="main" role="main">
			<aside id="sidebar-dashboard">
					<a href="#">All properties</a>
			</aside>
			<div class="addPropertyFormContianer">
				<div class="listing-holder">
					<a class="listing-opener"><span class="icon-menu"></span></a>
					<ul class="section-listing">
						<li class="activeAddPropertyNavLink"><a href="#basics-block" class="scrollAddPropertyNavLink"><span class="icon-info"></span>Basic</a></li>
						<li><a href="#feature-block" class="scrollAddPropertyNavLink"><span class="icon-symbol"></span> Features</a></li>
						<li><a href="#attactment-block" class="scrollAddPropertyNavLink"><span class="icon-clip"></span> Attachments</a></li>
						<li><a href="#contact-information" class="scrollAddPropertyNavLink"><span class="icon-contact_phone"></span> Contact Info</a></li>
					</ul>
				</div>
				<form action="#" class="property-add">
					<section class="basics-block" id="basics-block">
						<strong class="form-heading"><span>Property Type and Location</span></strong>
						<div class="layout">
							<span class="title">purpose:</span>
							<div class="input-holder">
								<ul class="radio-holder">
									<li>
										<label for="sale">
											<input type="radio" name="radio" id="sale" required>
											<span class="fake-radio"></span>
											<span class="fake-label">For Sale</span>
										</label>
									</li>
									<li>
										<label for="rent">
											<input type="radio" name="radio" id="rent" required>
											<span class="fake-radio"></span>
											<span class="fake-label">Rent</span>
										</label>
									</li>
								</ul>
							</div>
						</div>
						<div class="layout">
							<span class="title">Property Type:</span>
							<div class="input-holder">
								<ul class="tabset">
									<li><a href="#tab1"><span class="round"></span>Home</a></li>
									<li><a href="#tab2"><span class="round"></span>Plots</a></li>
									<li><a href="#tab3"><span class="round"></span>Commercial</a></li>
								</ul>
								<div class="tab-content">
									<div id="tab1">
										<ul class="radio-holder">
											<li>
												<label for="house">
													<input type="radio" name="radio1" id="house" required>
													<span class="fake-radio"></span>
													<span class="fake-label">House</span>
												</label>
											</li>
											<li>
												<label for="flat">
													<input type="radio" name="radio1" id="flat" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Rent</span>
												</label>
											</li>
											<li>
												<label for="upperP">
													<input type="radio" name="radio1" id="upperP" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Upper Portion</span>
												</label>
											</li>
											<li>
												<label for="lowerP">
													<input type="radio" name="radio1" id="lowerP" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Lower Portion</span>
												</label>
											</li>
											<li>
												<label for="farmH">
													<input type="radio" name="radio1" id="farmH" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Farm House</span>
												</label>
											</li>
											<li>
												<label for="room">
													<input type="radio" name="radio1" id="room" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Room</span>
												</label>
											</li>
											<li>
												<label for="pentH">
													<input type="radio" name="radio1" id="pentH" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Penthouse</span>
												</label>
											</li>
										</ul>
									</div>
									<div id="tab2">
										<ul class="radio-holder">
											<li>
												<label for="residentialP">
													<input type="radio" name="radio1" id="residentialP" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Residential Plot</span>
												</label>
											</li>
											<li>
												<label for="commericalP">
													<input type="radio" name="radio1" id="commericalP" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Commercial Plot</span>
												</label>
											</li>
											<li>
												<label for="aggriculture">
													<input type="radio" name="radio1" id="aggriculture" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Aggriculture Land</span>
												</label>
											</li>
											<li>
												<label for="industry">
													<input type="radio" name="radio1" id="industry" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Industrial Land</span>
												</label>
											</li>
											<li>
												<label for="pFile">
													<input type="radio" name="radio1" id="pFile" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Plot File</span>
												</label>
											</li>
											<li>
												<label for="pForm">
													<input type="radio" name="radio1" id="pForm" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Plot Form</span>
												</label>
											</li>
										</ul>
									</div>
									<div id="tab3">
										<ul class="radio-holder">
											<li>
												<label for="office">
													<input type="radio" name="radio1" id="office" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Office</span>
												</label>
											</li>
											<li>
												<label for="shop">
													<input type="radio" name="radio1" id="shop" required>												
													<span class="fake-radio"></span>
													<span class="fake-label">Shop</span>
												</label>
											</li>
											<li>
												<label for="wareHouse">
													<input type="radio" name="radio1" id="wareHouse" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Warehouse</span>
												</label>
											</li>
											<li>
												<label for="fectory">
													<input type="radio" name="radio1" id="fectory" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Fectory</span>
												</label>
											</li>
											<li>
												<label for="building">
													<input type="radio" name="radio1" id="building" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Building</span>
												</label>
											</li>
											<li>
												<label for="other">
													<input type="radio" name="radio1" id="other" required>
													<span class="fake-radio"></span>
													<span class="fake-label">Other</span>
												</label>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">Society:</span>
								<select class="searchable-select">
									<option>Select Block</option>
									<option>Block</option>
									<option>Block</option>
									<option>Block</option>
									<option>Block</option>
									<option>Block</option>
									<option>Block</option>
									<option>Block</option>
								</select>
							</div>
							<div class="layout-holder">
								<span class="title">Block:</span>
								<select class="searchable-select">
									<option>Select Area</option>
									<option>Area</option>
									<option>Area</option>
									<option>Area</option>
									<option>Area</option>
									<option>Area</option>
									<option>Area</option>
									<option>Area</option>
								</select>
							</div>
						</div>
						<strong class="form-heading"><span>Property &amp; Area</span></strong>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">Price:</span>
								<input type="number" required>
							</div>
							<span class="calculatedPrice"></span>
						</div>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">Land Area:</span>
								<input type="number" step="any" required>
							</div>
							<div class="layout-holder">
								<span class="title">Unit:</span>
								<select>
									<option>Select Unit</option>
									<option>Squar Feet</option>
									<option>Squar Yards</option>
									<option>Squar Meters</option>
									<option>Marla</option>
									<option>Kanal</option>
								</select>
							</div>
						</div>
						<strong class="form-heading"><span>Property Details</span></strong>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">Property Title:</span>
								<input type="text" required>
							</div>
							<div class="layout-holder">
								<span class="title">Bedrooms:</span>
								<input type="number" required>
							</div>
						</div>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">Bath:</span>
								<input type="number" required>
							</div>
							<div class="layout-holder">
								<span class="title">Rooms:</span>
								<input type="number" required>
							</div>
						</div>
						<div class="layout add">
							<div class="layout-holder add">
								<span class="title">Description:</span>
								<textarea required></textarea>
							</div>
						</div>
					</section>
					<section class="feature-block" id="feature-block">
						<strong class="form-heading"><span>extra features</span></strong>
						<div class="holder">
							<span class="tag">Indoor features</span>
							<ul class="feature-list">
								<li>
									<input type="checkbox">
									<label>Alarm System</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Intercom</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ensuite</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Dishwasher</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Built-in wardrobes</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ducted vacuum system</label>
								</li>
							</ul>
							<span class="tag">outdoor features</span>
							<ul class="feature-list">
								<li>
									<input type="checkbox">
									<label>Alarm System</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Intercom</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ensuite</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Dishwasher</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Built-in wardrobes</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ducted vacuum system</label>
								</li>
							</ul>
							<span class="tag">eco features</span>
							<ul class="feature-list">
								<li>
									<input type="checkbox">
									<label>Alarm System</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Intercom</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ensuite</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Dishwasher</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Built-in wardrobes</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ducted vacuum system</label>
								</li>
							</ul>
							<span class="tag">other features</span>
							<ul class="feature-list">
								<li>
									<input type="checkbox">
									<label>Alarm System</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Intercom</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ensuite</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Dishwasher</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Built-in wardrobes</label>
								</li>
								<li>
									<input type="checkbox">
									<label>Ducted vacuum system</label>
								</li>
							</ul>
						</div>
					</section>
					<section class="attactment-block" id="attactment-block">
						<strong class="form-heading"><span>attactments</span></strong>
						<ul class="image-uploading-area">
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb1" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">	
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb2')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb2" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb3')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb3" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb4')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb4" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb5')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb5" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb6')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb6" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb7')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb7" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
							<li>
								<div class="file-uploader">
									<input type="file" onchange="previewAddPropertyImg(this , '.img-thumb8')" class="upload-img">
									<div class="image-holder">
										<img src="#" class="img-thumb8" alt="image Description">
										<span class="propertyDocumentCloseBtn"><span class="icon-cross"></span></span>
									</div>
								</div>
								<input type="text" class="picture-name disableInput" placeholder="Title">
							</li>
						</ul>
					</section>
					<section class="contact-information" id="contact-information">
						<strong class="form-heading"><span>Contact info</span></strong>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">owner:</span>
								<select class="searchable-select">
									<option>Select Block</option>
								</select>
							</div>
							<div class="layout-holder">
								<span class="title">contact person:</span>
								<input type="text" required>
							</div>
						</div>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">Phone:</span>
								<input type="text" required>
							</div>
							<div class="layout-holder">
								<span class="title">Cell:</span>
								<input type="text" required>
							</div>
						</div>
						<div class="layout add">
							<div class="layout-holder">
								<span class="title">fax:</span>
								<input type="text" required>
							</div>
							<div class="layout-holder">
								<span class="title">email:</span>
								<input type="email" required>
							</div>
						</div>
					</section>
					<button type="submit"><span class="icon-arrows"></span>Save Property</button>
				</form>
			</div>
		</main>
	</div>
	<!-- include jQuery library -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" defer></script>
	<script type="text/javascript">window.jQuery || document.write('<script src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/jquery-1.11.2.min.js" defer><\/script>')</script>
	<script type="text/javascript" src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/select2.full.js" defer></script>
	<!-- include custom JavaScript -->
	<script type="text/javascript" src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/tabset-plugin.js" defer></script>
	<script type="text/javascript" src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/helper.js" defer></script>
	<script type="text/javascript" src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/add-propertyFrom.js" defer></script>
	<script type="text/javascript" src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/dashboard.js" defer></script>
	<script type="text/javascript" src="{{\App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version'])}}/js/jquery.main.js" defer></script>
</body>
</html>
