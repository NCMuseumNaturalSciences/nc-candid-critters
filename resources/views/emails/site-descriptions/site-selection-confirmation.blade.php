<div class="email-wrapper">
<p>Hello Candid Critters Citizen Scientist,<p>

<p>Thank you for selecting a deployment site on the Site Selection Map!</p>
<p>Here is the information about your selected site:</p>
    <ul>
        <li>Deployment Name: {{ $sd->deployment_name }}</li>
        <li>Coordinates: {{ $sd->acf_lat  }}, {{ $sd->acf_long }}</li>
        @if($sd->mapSite)
        <li>Site Manager Notes: {{ $sd->mapSite->infowindow_content }}</li>
        @endif
        <li>Submitted On: {{ $dt->format('g:i A') }} {{ $dt->format('l F d, Y') }}</li>
    </ul>
<p><a href="https://candid.naturalsciences.org/map/site/{{ $sd->map_site_id }}">View Map</a>.</p>

<p>We will be using this site's information to assign you a deployment in eMammal. Please wait 2-3 days for your deployment to appear in your project dashboard on eMammal.org and in the eMammal desktop application.</p>
<p><strong><u>To locate your deployment site coordinates and other information, please check your project dashboard.</u></strong> The dashboard can be accessed by clicking on the  icon at the top of page next to your name and selecting "Project Dashboard" from the dropdown menu. When the dashboard appears, you should be able to see "Deployments" at the bottom of the page. Once you click your deployment name, the coordinates will be listed below. Please visit "<a href="http://www.nccandidcritters.org/wp-content/uploads/2017/03/ProjectDashboard.png">http://www.nccandidcritters.org/wp-content/uploads/2017/03/ProjectDashboard.png</a>" for an example.</p>
<p><strong><u>Please remember to bring a <a href="https://www.nccandidcritters.org/wp-content/uploads/2016/10/Data_Sheet.pdf">data sheet</a> with you when you set your camera so you can fill in the necessary information from your field work.</u></strong> You will be able to transfer the information you wrote on your paper data sheet to the electronic data sheet in the eMammal desktop application. Once your 3-week deployment is complete, you will be able to upload your images to your selected deployment name in the desktop application.</p>
<p>Please let us know if you have any questions.</p>

<p>Happy Camera Trapping!</p>

<p>Sincerely,<br>
    The Candid Critters Team<br>
    <a href="mailto:info@nccandidcritters.org">info@nccandidcritters.org</a><br>
    <a href="https://www.nccandidcritters.org">https://www.NCCandidCritters.org</a></p>
</div>
