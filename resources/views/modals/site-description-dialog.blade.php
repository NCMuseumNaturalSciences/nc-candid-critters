<!-- jQuery UI Dialog Window for Site Selection -->
<div class="site-info-dialog" id="site-info-dialog">
    <div class="dialog-content">
        <div class="dialog-header">
        </div>
        <div class="dialog-body">
            <span class="response-message"></span>
            <span class="response-error"></span>
            <h4>Deployment: <span class="deployment-name"></span></h4>
            <ul class="info-list">
                <li class="county">County: <span></span></li>
                <li class="lat">Latitude: <span></span></li>
                <li class="long">Longitude: <span></span></li>
            </ul>
            <p>If you have any questions about this site, please contact us at <a href="mailto:info@nccandidcritters.org">info@nccandidcritters.org</a>.</p>
            @role('administrator')
                <a href="" class="admin-link">Return to Site Description</a>
            @endrole
        </div>
    </div>
</div>
