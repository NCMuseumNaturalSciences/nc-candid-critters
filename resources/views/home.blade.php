@extends('layouts.frontend.master', ['bodyid' => 'page'])
@section('content')
		<div class="home-container container">
			<div class="row">
				<div class="col">
					<h2>Overview</h2>
					<p><strong>North Carolina&#8217;s Candid Critters is a citizen scientist run camera trap survey of wildlife in North Carolina.</strong><strong><a href="https://www.nccandidcritters.org/sign-up/">Help us</a> figure out what mammals are living where in our state to help wildlife conservation and management!</strong> Candid Critters is a collaboration between <a href="https://cnr.ncsu.edu/fer/">NC State University</a>, <a href="http://naturalsciences.org/research-collections/biodiversity-lab">NC Museum of Natural Sciences</a>, <a href="http://www.ncwildlife.org">NC Wildlife Resources Commission</a>, the <a href="http://statelibrary.ncdcr.gov/">State Library of NC</a>, <a href="http://statelibrary.ncdcr.gov/ld/services/nccardinal.html">NC Cardinal</a>, the Public Libraries of North Carolina, and the <a href="http://emammal.si.edu">Smithsonian</a>.</p>

					<h2>Objectives</h2>
					<p>We want to <strong>engage North Carolina citizens</strong> <strong>in science</strong>. We work with people of all ages, backgrounds, and experience to help us study the wildlife of their state through camera trapping.</p>

					<p>Our second objective is to <strong>collect wildlife data</strong> that will be useful for management and conservation questions proposed by the NC Wildlife Resources Commission and other organizations.</p>


					<h2>What are our scientific questions?</h2>
					<ol>
					    <li>Is the deer population in NC increasing, decreasing, or staying the same?</li>
					    <li>Where are coyotes and how abundant are they in NC?</li>
					    <li>Where are other species of concern in NC? Where can we find bear, elk, weasels, fox squirrels, red squirrels, armadillos, woodrats, feral pigs, chipmunks, and skunks?</li>
					</ol>


					<h2>How will we accomplish theses goals?</h2>
					<p>The NC Candid Critters project is working with citizen science volunteers of all ages and backgrounds to set camera traps (motion and heat sensitive trail cameras) around the state to help us learn about our wildlife. Citizen scientists gets to explore the outdoors and learn about the critters living in their community, while helping us gain information that can be used for conservation and management purposes. Cameras are set out for 3-week periods, and all images are reviewed and uploaded by citizen science volunteers in a custom software program called eMammal.</p>


					<h2>What is eMammal?</h2>
					<p><a href="http://emammal.si.edu/">eMammal</a> is a set of tools used to collect and manage camera trap data. We use eMammal as an online database for our pictures; this is kind of like a digital filing cabinet for all the pictures collected by our project, and other projects around the world.</p>

<h2>Ready to Join Us?</h2>
					<p>Think you might be interested in participating in NC Candid Critters? Visit the <a href="https://www.nccandidcritters.org/how-it-works/">how it works</a> page to learn about what you&#8217;ll be doing as a citizen scientists or <a href="https://www.nccandidcritters.org/sign-up/">sign up to participate</a>!</p>

				</div>
			</div>
			<footer class="footer-home container h-100">
				<div class="row h-100 justify-content-center align-items-center">
					<div class="col-md-6 mx-auto">
						<a href="https://www.nccandidcritters.org/about-the-project/" class="img-wrap-link">
							<img src="{{ asset("images/nccc_web.jpg") }}" class="mx-auto d-block">
						</a>
					</div>
					<div class="col-md-6 mx-auto">
						 <a href="" class="img-wrap-link" >
							<img src="{{ asset("images/emammal.png") }}" class="mx-auto d-block">
						</a>
					</div>

				</div>

			</footer>
		</div>
@endsection
