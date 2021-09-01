<div id="form_result" role="alert"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title ribbon ribbon-left">
                <div class="ribbon-target" style="top: 6px;">
                    {{ $createButton ?? '' }}
                </div>
                <h4 class="text-center">{{ $title ?? '' }}</h4> 
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="fullscreen-link">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
            </div>
            <div>
                <div class="ibox-content no-padding border-left-right">
                    <img alt="image" class="img-fluid" src="img/profile_big.jpg">
                </div>
                <div class="ibox-content profile-content">
                <h4><strong>Monica Smith</strong></h4>
                <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                <h5>
                    About me
                </h5>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                </p>
                <div class="row m-t-lg">
                    <div class="col-md-4">
                        <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                        <h5><strong>169</strong> Posts</h5>
                    </div>
                    <div class="col-md-4">
                        <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                        <h5><strong>28</strong> Following</h5>
                    </div>
                    <div class="col-md-4">
                        <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
                        <h5><strong>240</strong> Followers</h5>
                    </div>
                </div>

                {{ $modals ?? '' }}
                
            </div>
        </div>
    </div>
</div>