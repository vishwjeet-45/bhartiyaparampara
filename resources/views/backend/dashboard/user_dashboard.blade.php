@extends('layouts/backend/main')
@section('main-section')
        <!-- Page Sidebar Ends-->
        <div class="page-body"> 
          <div class="container-fluid">
            <div class="page-header dash-breadcrumb">
              <div class="row">
                <div class="col-6">                              
                  <h3 class="f-w-600">default</h3>
                </div>
                <div class="col-6">
                  <div class="breadcrumb-sec">
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#"><i data-feather="home"></i></a></li>
                      <li class="breadcrumb-item">Dashboard</li>
                      <li class="breadcrumb-item active">Default</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid default-dash">
            <div class="row">                     
              <div class="col-xl-4 col-md-6 des-xl-50 box-col-6">
                <div class="card profile-greeting">
                  <div class="card-decore">
                    <div class="main"><img class="img-fluid" src="{{url('public/build/assets/backend/images/dashboard/1.png')}}" alt="Image description"></div>
                    <div class="dot dot1"></div>
                    <div class="dot dot2">    </div>
                    <div class="dot dot3">    </div>
                    <div class="dot dot4"></div>
                    <div class="cross cross1">    </div>
                    <div class="cross cross2">    </div>
                    <div class="cross cross3">    </div>
                  </div>
                  <div class="card-body">
                    <div class="greeting-user text-center">
                      <div>
                        <h1>Welcome                                      </h1>
                        <h6>Congratulations! Allie Grater</h6>
                        <p>Have you seen our latest blog post? Why not head over there and give it a read? We're sure you'll love it!                                      </p><a class="btn btn-light" href="blog.html" data-original-title="" title="">Check Update</a>
                      </div>
                    </div>
                  </div>
                  <canvas id="confetti"></canvas>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 des-xl-50 box-col-6">
                <div class="card latest-update-sec">
                  <div class="card-header">
                    <h5>Latest Update</h5>
                    <div class="card-header-right">
                      <ul class="setting-option">
                        <li>
                          <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-t-0">
                    <div id="chart-candle"></div>
                    <div class="update-block">
                      <div class="table-responsive custom-scrollbar">
                        <table class="table table-bordernone">
                          <tbody>
                            <tr>
                              <td>
                                <div class="update-widgets">
                                  <div class="icon bg-primary"><i class="fa fa-star"></i></div>
                                </div>
                              </td>
                              <td>                                             <span>Win best seller of the year award</span>
                                <p>Company San Francisco</p>
                              </td>
                              <td>
                                <p>34 minits ago</p>
                              </td>
                            </tr>
                            <tr> 
                              <td> 
                                <div class="update-widgets">
                                  <div class="icon bg-secondary me-3"><i class="fa fa-check-circle"></i></div>
                                </div>
                              </td>
                              <td>                                            <span>Approved our product in checking</span>
                                <p>Elisse joson,San francisco</p>
                              </td>
                              <td>
                                <p>1 hour ago</p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#letest-update" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre>                                          <code class="language-html" id="letest-update">&lt;div class="card latest-update-sec"&gt;
 &lt;div class="card-header"&gt;
 &lt;h5&gt;Latest Update&lt;/h5&gt;
 &lt;div class="card-header-right"&gt;
 &lt;ul class="setting-option"&gt;
 &lt;li&gt;&lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;/ul&gt;
 &lt;/div&gt;
 &lt;/div&gt;
 &lt;div class="card-body p-t-0"&gt;
 &lt;div id="chart-candle"&gt;&lt;/div&gt;
 &lt;div class="update-block"&gt;
 &lt;div class="table-responsive"&gt;
 &lt;table class="table table-bordernone"&gt;
 &lt;tbody&gt;
   &lt;tr&gt;
     &lt;td&gt;
       &lt;div class="update-widgets"&gt;
         &lt;div class="icon bg-primary"&gt;
           &lt;i class="fa fa-star"&gt;&lt;/i&gt;
         &lt;/div&gt;
       &lt;/div&gt;
     &lt;/td&gt;
     &lt;td&gt; 
       &lt;span&gt;Win best seller of the year award&lt;/span&gt;
       &lt;p&gt;Company San Francisco&lt;/p&gt;
     &lt;/td&gt;
     &lt;td&gt;
       &lt;p&gt;34 minits ago&lt;/p&gt;
     &lt;/td&gt;
     &lt;/tr&gt;
     &lt;tr&gt; 
     &lt;td&gt; 
     &lt;div class="update-widgets"&gt;
     &lt;div class="icon bg-secondary me-3"&gt;&lt;i class="fa fa-check-circle"&gt;&lt;/i&gt;&lt;/div&gt;
     &lt;/div&gt;
     &lt;/td&gt;
     &lt;td&gt; &lt;span&gt;Approved our product in checking&lt;/span&gt;
     &lt;p&gt;Elisse joson,San francisco&lt;/p&gt;
     &lt;/td&gt;
     &lt;td&gt;&lt;p&gt;1 hour ago&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;
   &lt;/table&gt;
 &lt;/div&gt;&lt;/div&gt;&lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 des-xl-100 box-col-12">
                <div class="row">
                  <div class="col-xl-12 col-sm-6 des-xl-50 box-col-6">
                    <div class="card daily-earning-sec">
                      <div class="card-header">
                        <h5>Dailly Earning</h5>
                        <div class="card-header-right">
                          <ul class="setting-option">
                            <li>
                              <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                            </li>
                            <li><i class="view-html fa fa-code font-primary"></i></li>
                            <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                            <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                            <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                            <li><i class="icofont icofont-error close-card font-primary"></i></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body p-t-0">
                        <h3 class="d-flex">$
                          <div class="counter">8,55,462</div>
                        </h3>
                        <div class="progress-gradient-fill">
                          <div class="progress sm-progress-bar"> 
                            <div class="progress-gradient-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="tag-section d-flex justify-content-between align-items-end">
                          <div class="tag-content d-flex"><i class="fa fa-arrow-up toprightarrow-primary"></i><span>78.21%</span>
                            <p>More than last year</p>
                          </div>
                          <div class="round-tag"><i class="fa fa-usd"></i></div>
                        </div>
                        <div class="code-box-copy">
                          <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#dailly-earning" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                          <pre><code class="language-html" id="dailly-earning">&lt;div class="card daily-earning-sec"&gt;
&lt;div class="card-header"&gt;
&lt;h5&gt;Dailly Earning&lt;/h5&gt;
&lt;div class="card-header-right"&gt;
&lt;ul class="setting-option"&gt;
&lt;li&gt;
&lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;
&lt;/li&gt;
&lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;/ul&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class="card-body p-t-0"&gt;
&lt;h3 class="d-flex"&gt;$&lt;div class="counter"&gt;8,55,462&lt;/div&gt;&lt;/h3&gt;
&lt;div class="progress-gradient-fill"&gt;
&lt;div class="progress sm-progress-bar"&gt; 
&lt;div class="progress-gradient-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="tag-section d-flex justify-content-between align-items-end"&gt;
&lt;div class="tag-content d-flex"&gt;&lt;i class="fa fa-arrow-up toprightarrow-primary"&gt;&lt;/i&gt;&lt;span&gt;78.21%&lt;/span&gt;
&lt;p&gt;More than last year&lt;/p&gt;
&lt;/div&gt;
&lt;div class="round-tag"&gt;&lt;i class="fa fa-usd"&gt;&lt;/i&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;</code></pre>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-sm-6 des-xl-50 box-col-6">
                    <div class="card total-events-sec">
                      <div class="card-header justify-content-between">
                        <h5>Total Events</h5>
                        <div class="center-content">
                          <p>last year events</p><span class="counter">5945</span>
                        </div>
                        <div class="card-header-right">
                          <ul class="setting-option">
                            <li>
                              <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                            </li>
                            <li><i class="view-html fa fa-code font-primary"></i></li>
                            <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                            <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                            <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                            <li><i class="icofont icofont-error close-card font-primary"></i></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body p-0">
                        <div class="apex-complain">
                          <div id="mix1"></div>
                        </div>
                        <div class="small-mix"></div>
                        <div class="code-box-copy">
                          <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#total-events" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                          <pre><code class="language-html" id="total-events">&lt;div class="card total-events-sec"&gt;
 &lt;div class="card-header justify-content-between"&gt;
 &lt;h5&gt;Total Events&lt;/h5&gt;
 &lt;div class="center-content"&gt;
 &lt;p&gt;last year events&lt;/p&gt;
 &lt;span class="counter"&gt;5945&lt;/span&gt;
 &lt;/div&gt;
 &lt;div class="card-header-right"&gt;
 &lt;ul class="setting-option"&gt;
 &lt;li&gt;
 &lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;
 &lt;/li&gt;
 &lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;/ul&gt;
 &lt;/div&gt;
 &lt;/div&gt;
 &lt;div class="card-body p-0"&gt;
 &lt;div class="apex-complain"&gt;
 &lt;div id="mix1"&gt;&lt;/div&gt;
 &lt;/div&gt;
 &lt;div class="small-mix"&gt;&lt;/div&gt;
 &lt;/div&gt;
&lt;/div&gt;</code></pre>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 col-md-6 des-md-55 des-xl-55 xl-50 box-col-6">
                <div class="card monthly-earning-sec">
                  <div class="card-header justify-content-between">
                    <h5>Quick Option</h5>
                    <div class="center-content">
                      <div class="center-content-left">
                        <p>Total transaction</p><span class="counter">66548400                                    </span>
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-t-0">
                    <div class="row options-main">
                      <div class="col-4">
                        <div class="option-box"><i class="icofont icofont-bill-alt txt-primary"></i>
                          <h5>25500</h5>
                          <h6>Cash On Hand</h6>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="option-box"><i class="icofont icofont-bank-alt txt-secondary"></i>
                          <h5>30000</h5>
                          <h6>Bank balance                                        </h6>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="option-box"><i class="icofont icofont-mastercard txt-success"></i>
                          <h5>Mastercard</h5>
                          <h6>Credit card</h6>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="option-box"><i class="icofont icofont-trophy-alt txt-info"></i>
                          <h5>435.5</h5>
                          <h6>Total cashback</h6>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="option-box"><i class="icofont icofont-ticket txt-warning"></i>
                          <h5>Unlock 5</h5>
                          <h6>Coupans</h6>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="option-box"><i class="icofont icofont-maestro txt-danger"></i>
                          <h5>3500</h5>
                          <h6>Win Points</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 col-md-6 des-md-45 xl-50 des-xl-45 box-col-6">
                <div class="card dash-chat">
                  <div class="card-header pb-0">
                    <h5>Recent messages</h5>
                  </div>
                  <div class="card-body">
                    <div class="chat-box dashboard-chat">
                      <div class="chat">
                        <div class="media left-side-chat"><a href="user-profile.html"><img class="rounded-circle chat-user-img img-40 m-r-10" src="{{url('public/build/assets/backend/images/user/4.jpg')}}" alt=""></a>
                          <div class="media-body">
                            <div class="message-main">
                              <p class="mb-0">Hi I am Alan,can you help me to find best admin?.</p>
                            </div>
                          </div>
                        </div>
                        <div class="media right-side-chat">
                          <div class="media-body text-right">
                            <div class="message-main">
                              <p class="pull-right">Sure, wingo is best admin for your project, you can it check<a href="https://themeforest.net/user/pixelstrap/portfolio"> Here</a></p>
                            </div>
                          </div><a href="user-profile.html"><img class="rounded-circle chat-user-img img-40 m-l-10" src="{{url('public/build/assets/backend/images/user/5.jpg')}}" alt=""></a>
                        </div>
                        <div class="media m-t-10 left-side-chat"><a href="user-profile.html"><img class="rounded-circle chat-user-img img-40 m-r-10" src="{{url('public/build/assets/backend/images/user/4.jpg')}}" alt=""></a>
                          <div class="media-body">
                            <div class="message-main">
                              <p>I checked it's nice theme, Thanks man.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="media chat-footer bg-primary"><a href="user-profile.html"><img class="img-fluid imogi" src="{{url('public/build/assets/backend/images/smiley.png')}}" alt=""></a>
                      <div class="media-body">
                        <input class="form-control" type="text" placeholder="Type your message" required="">
                      </div><a class="d-flex" href="chat.html"><i data-feather="fast-forward">                             </i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 col-md-6 des-xl-50 xl-40 box-col-6">
                <div class="card pro-valuation-sec">
                  <div class="card-header pb-0">
                    <h5>Product Valuation</h5>
                    <div class="card-header-right">
                      <ul class="setting-option">
                        <li>
                          <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body py-0">
                    <div id="valuation-chart"></div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#product-valuation" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="product-valuation">&lt;div class="card pro-valuation-sec"&gt;
&lt;div class="card-header pb-0"&gt;
&lt;h5&gt;Product Valuation&lt;/h5&gt;
&lt;div class="card-header-right"&gt;
&lt;ul class="setting-option"&gt;
&lt;li&gt;&lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="card-body py-0"&gt;
&lt;div id="valuation-chart"&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 des-xl-50 col-lg-6 col-md-6 col-sm-6 xl-30 box-col-6 des-order-2">
                <div class="card profile-sec">
                  <div class="card-header pb-0">
                    <h5>Profile</h5>
                    <div class="card-header-right">
                      <ul class="setting-option">
                        <li>
                          <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-t-0">
                    <div class="user-details-main">
                      <div class="user-img"><img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/profile_img.png')}}" alt="Card image cap"><span class="badge flat-badge-primary">New</span></div>
                      <div class="user-detail"><a href="user-profile.html"><span>Emay Walter</span></a>
                        <p>Mahager</p>
                      </div>
                    </div>
                    <div class="user-content">
                      <div class="small-bar">
                        <div class="small-chart1 flot-chart-container"></div>
                      </div>
                      <div class="user-content-right"><span>+26%</span>
                        <p>Productivity                        </p>
                      </div>
                    </div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#profile-sec" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="profile-sec">&lt;div class="card profile-sec"&gt;
&lt;div class="card-header pb-0"&gt;&lt;h5&gt;Profile&lt;/h5&gt;
&lt;div class="card-header-right"&gt;
&lt;ul class="setting-option"&gt;
&lt;li&gt;&lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;&lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="card-body p-t-0"&gt;
&lt;div class="user-details-main"&gt;
&lt;div class="user-img"&gt;&lt;img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/profile_img.png')}}" alt="Card image cap"/&gt;&lt;span class="badge flat-badge-primary"&gt;New&lt;/span&gt;&lt;/div&gt;
&lt;div class="user-detail"&gt;&lt;a href="user-profile.html"&gt;&lt;span&gt;Emay Walter&lt;/span&gt;&lt;/a&gt;
&lt;p&gt;Mahager&lt;/p&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="user-content"&gt;
&lt;div class="small-bar"&gt;
&lt;div class="small-chart1 flot-chart-container"&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;div class="user-content-right"&gt;&lt;span&gt;+26%&lt;/span&gt;
&lt;p&gt;Productivity&lt;/p&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 des-xl-100 xl-100 box-col-12 deals-sec">
                <div class="card">
                  <div class="card-body">
                    <div class="best-dealer-table responsive-tbl">
                      <div class="item">
                        <div class="table-responsive product-list">
                          <table class="table table-bordernone">
                            <thead>
                              <tr>
                                <th>Deals</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Projects</th>
                                <th>Country</th>
                                <th>Currency</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>01</td>
                                <td>
                                  <div class="t-title d-inline-block align-middle"><a href="user-profile.html"><img class="img-40 m-r-15 rounded-circle align-top" src="{{url('public/build/assets/backend/images/dashboard/p-1.png')}}" alt="" data-original-title="" title=""></a>
                                    <div class="status-circle bg-primary"></div>
                                    <div class="d-inline-block"><span>Ossim keter</span>
                                      <p>2019</p>
                                    </div>
                                  </div>
                                </td>
                                <td>16 August</td>
                                <td>Graden</td>
                                <td><i class="flag-icon flag-icon-gb"></i></td>
                                <td><span class="label">$1,58,652                                           </span></td>
                              </tr>
                              <tr>
                                <td>02</td>
                                <td>
                                  <div class="t-title d-inline-block align-middle"><a href="user-profile.html"><img class="img-40 m-r-15 rounded-circle align-top" src="{{url('public/build/assets/backend/images/dashboard/p-2.png')}}" alt="" data-original-title="" title=""></a>
                                    <div class="status-circle bg-primary"></div>
                                    <div class="d-inline-block"><span>Venter loren</span>
                                      <p>2018</p>
                                    </div>
                                  </div>
                                </td>
                                <td>21 September</td>
                                <td>Business Hub</td>
                                <td><i class="flag-icon flag-icon-us"></i></td>
                                <td><span class="label">$95,025                                           </span></td>
                              </tr>
                              <tr>
                                <td>03</td>
                                <td>
                                  <div class="t-title d-inline-block align-middle"><a href="user-profile.html"><img class="img-40 m-r-15 rounded-circle align-top" src="{{url('public/build/assets/backend/images/dashboard/p-3.png')}}" alt="" data-original-title="" title=""></a>
                                    <div class="status-circle bg-primary"></div>
                                    <div class="d-inline-block"><span>Fran loain</span>
                                      <p>2019</p>
                                    </div>
                                  </div>
                                </td>
                                <td>06 March</td>
                                <td>Water Park</td>
                                <td><i class="flag-icon flag-icon-za"></i></td>
                                <td><span class="label">$90,155                                           </span></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 des-xl-50 xl-30 col-lg-6 col-md-6 col-sm-6 box-col-6 des-order-1">
                <div class="card social-review-sec">
                  <div class="card-header">
                    <h5>Social Review</h5>
                    <div class="card-header-right">
                      <ul class="setting-option">
                        <li>
                          <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-t-0 p-b-0 social-main">
                    <div class="social-review-content">
                      <h5 class="counter">6895</h5>
                      <div class="star-sec-main">
                        <h6 class="mb-0">You got +65%</h6>
                        <ul class="star-sec">
                          <li><i class="fa fa-star"></i></li>
                          <li><i class="fa fa-star"></i></li>
                          <li><i class="fa fa-star"></i></li>
                          <li><i class="fa fa-star"></i></li>
                          <li><i class="fa fa-star"></i></li>
                        </ul>
                      </div>
                      <p>More reviews than last week</p>
                    </div>
                    <ul class="reviewer-profile">
                      <li><a href="user-profile.html"><img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/1.png')}}" alt="Card image cap"></a></li>
                      <li><a href="user-profile.html"><img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/2.png')}}" alt="Card image cap"></a></li>
                      <li><a href="user-profile.html"><img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/3.png')}}" alt="Card image cap"></a></li>
                      <li><a href="user-profile.html"><img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/4.png')}}" alt="Card image cap"></a></li>
                      <li><a href="user-profile.html"><img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/5.png')}}" alt="Card image cap"></a></li>
                    </ul>
                    <ul class="review-details">
                      <li>
                        <div class="left-review"><span class="counter">6521</span>
                          <p>5 star review</p>
                        </div>
                      </li>
                      <li>
                        <div class="right-review"><span class="counter">0374</span>
                          <p>4 start review</p>
                        </div>
                      </li>
                    </ul>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#social-review" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="social-review">&lt;div class="card social-review-sec"&gt;
 &lt;div class="card-header"&gt;
 &lt;h5&gt;Social Review&lt;/h5&gt;
 &lt;div class="card-header-right"&gt;
 &lt;ul class="setting-option"&gt;
 &lt;li&gt;&lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;/ul&gt;
 &lt;/div&gt;
 &lt;/div&gt;
 &lt;div class="card-body p-t-0 p-b-0 social-main"&gt;
 &lt;div class="social-review-content"&gt;
 &lt;h5 class="counter"&gt;6895&lt;/h5&gt;
 &lt;div class="star-sec-main"&gt;
 &lt;h6 class="mb-0"&gt;You got +65%&lt;/h6&gt;
 &lt;ul class="star-sec"&gt;
 &lt;li&gt;&lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;li&gt;&lt;i class="fa fa-star"&gt;&lt;/i&gt;&lt;/li&gt;
 &lt;/ul&gt;
 &lt;/div&gt;
 &lt;p&gt;More reviews than last week&lt;/p&gt;
 &lt;/div&gt;
 &lt;ul class="reviewer-profile"&gt;
 &lt;li&gt;&lt;a href="user-profile.html"&gt;&lt;img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/1.png')}}" alt="Card image cap"/&gt;&lt;/a&gt;&lt;/li&gt;
 &lt;li&gt;&lt;a href="user-profile.html"&gt;&lt;img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/2.png')}}" alt="Card image cap"/&gt;&lt;/a&gt;&lt;/li&gt;
 &lt;li&gt;&lt;a href="user-profile.html"&gt;&lt;img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/3.png')}}" alt="Card image cap"/&gt;&lt;/a&gt;&lt;/li&gt;
 &lt;li&gt;&lt;a href="user-profile.html"&gt;&lt;img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/4.png')}}" alt="Card image cap"/&gt;&lt;/a&gt;&lt;/li&gt;
 &lt;li&gt;&lt;a href="user-profile.html"&gt;&lt;img class="rounded-circle" src="{{url('public/build/assets/backend/images/dashboard/social/5.png')}}" alt="Card image cap"/&gt;&lt;/a&gt;&lt;/li&gt;
 &lt;/ul&gt;
 &lt;ul class="review-details"&gt;
 &lt;li&gt;
 &lt;div class="left-review"&gt;&lt;span class="counter"&gt;6521&lt;/span&gt;
 &lt;p&gt;5 star review&lt;/p&gt;
 &lt;/div&gt;&lt;/li&gt;
 &lt;li&gt;
 &lt;div class="right-review"&gt;&lt;span class="counter"&gt;0374&lt;/span&gt;
 &lt;p&gt;4 start review&lt;/p&gt;
 &lt;/div&gt;
 &lt;/li&gt;
 &lt;/ul&gt;
 &lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 col-md-6 des-xl-50 box-col-6 box-col-6">
                <div class="card statistics-sec">
                  <div class="card-header">
                    <h5>Statistics</h5>
                    <div class="card-header-right">
                      <ul class="setting-option">
                        <li>
                          <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body chart-block p-0">
                    <div id="chart-statistics"></div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#statistics-sec" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="statistics-sec">&lt;div class="card statistics-sec"&gt;
&lt;div class="card-header"&gt;
&lt;h5&gt;Statistics&lt;/h5&gt;
&lt;div class="card-header-right"&gt;
&lt;ul class="setting-option"&gt;
&lt;li&gt;
&lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;div class="card-body chart-block p-0"&gt;
&lt;div id="chart-statistics"&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;div class="card-footer"&gt;
&lt;div class="statistics-details text-center"&gt;
&lt;table class="table table-bordernone"&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td&gt;&lt;span&gt;Emails&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;
&lt;h6&gt; &lt;i class="fa fa-arrow-up font-primary me-1"&gt; &lt;/i&gt;&lt;span class="font-primary me-1"&gt;22 &lt;/span&gt;Growth in Last Week&lt;/h6&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;8457&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;&lt;td&gt;&lt;span&gt;Events&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;
&lt;h6&gt;&lt;i class="fa fa-arrow-down me-1 font-secondary"&gt;&lt;/i&gt;&lt;span class="font-secondary me-1"&gt;8&lt;/span&gt;in Last Week&lt;/h6&gt;
&lt;/td&gt;
&lt;td&gt;&lt;span&gt;16&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;&lt;span&gt;Visits&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;
&lt;h6&gt;&lt;i class="fa fa-arrow-up font-info me-1"&gt;&lt;/i&gt;&lt;span class="font-info me-1"&gt;22&lt;/span&gt;Great Growth in Last Week&lt;/h6&gt;
&lt;/td&gt;
&lt;td&gt;&lt;span&gt;8457&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="statistics-details text-center">
                      <table class="table table-bordernone">
                        <tbody>
                          <tr>
                            <td><span>Emails</span></td>
                            <td>
                              <h6> <i class="fa fa-arrow-up font-primary me-1"> </i><span class="font-primary me-1">22 </span>Growth in Last Week</h6>
                            </td>
                            <td><span>8457</span></td>
                          </tr>
                          <tr>
                            <td><span>Events</span></td>
                            <td>
                              <h6><i class="fa fa-arrow-down me-1 font-secondary"></i><span class="font-secondary me-1">8</span>in Last Week</h6>
                            </td>
                            <td><span>16</span></td>
                          </tr>
                          <tr>
                            <td><span>Visits</span></td>
                            <td>
                              <h6><i class="fa fa-arrow-up font-info me-1"></i><span class="font-info me-1">22</span>Great Growth in Last Week</h6>
                            </td>
                            <td><span>8457</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 des-xl-50 box-col-6">
                <div class="card goal-overview-sec">
                  <div class="card-header">
                    <h5>Goal Overview</h5>
                    <div class="card-header-right">
                      <ul class="setting-option">
                        <li>
                          <div class="setting-badge"><i class="fa fa-spin fa-cog font-primary"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code font-primary"></i></li>
                        <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                        <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                        <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                        <li><i class="icofont icofont-error close-card font-primary"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-b-0 text-center">
                    <div class="goal-chart-block">
                      <div class="goal-overview-chart"></div>
                      <div class="highest-goal"><span>$3.9k</span>
                        <p>Highest</p>
                      </div>
                    </div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#goal-view" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="goal-view"> &lt;div class="card goal-overview-sec"&gt;
 &lt;div class="card-header"&gt;
   &lt;h5&gt;Goal Overview&lt;/h5&gt;
   &lt;div class="card-header-right"&gt;
   &lt;ul class="setting-option"&gt;
     &lt;li&gt;
       &lt;div class="setting-badge"&gt;&lt;i class="fa fa-spin fa-cog font-primary"&gt;&lt;/i&gt;&lt;/div&gt;
     &lt;/li&gt;
     &lt;li&gt;&lt;i class="view-html fa fa-code font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
     &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
     &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
     &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
     &lt;li&gt;&lt;i class="icofont icofont-error close-card font-primary"&gt;&lt;/i&gt;&lt;/li&gt;
   &lt;/ul&gt;
   &lt;/div&gt;
   &lt;/div&gt;
   &lt;div class="card-body p-b-0 text-center"&gt;
   &lt;div class="goal-chart-block"&gt;
   &lt;div class="goal-overview-chart"&gt;&lt;/div&gt;
   &lt;div class="highest-goal"&gt;&lt;span&gt;$3.9k&lt;/span&gt;
   &lt;p&gt;Highest&lt;/p&gt;
   &lt;/div&gt;
   &lt;/div&gt;
   &lt;/div&gt;
   &lt;div class="card-footer"&gt;
   &lt;ul class="goal-details"&gt;
   &lt;li&gt;
   &lt;div class="complete-goal"&gt;
   &lt;h4&gt;65%&lt;/h4&gt;&lt;span&gt;Completed Goal&lt;/span&gt;
   &lt;/div&gt;
   &lt;/li&gt;
   &lt;li&gt;
   &lt;div class="expected-goal"&gt;
   &lt;h4&gt;98%&lt;/h4&gt;&lt;span&gt;Our Expected Goal&lt;/span&gt;
   &lt;/div&gt;
   &lt;/li&gt;
   &lt;/ul&gt;
   &lt;/div&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </div>
                  <div class="card-footer">
                    <ul class="goal-details">
                      <li>
                        <div class="complete-goal">
                          <h4>65%</h4><span>Completed Goal</span>
                        </div>
                      </li>
                      <li>
                        <div class="expected-goal">
                          <h4>98%</h4><span>Our Expected Goal</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 des-xl-50 box-col-6">
                <div class="card o-hidden help-sec">
                  <div class="card-header">
                    <div class="badge-main w-100">
                      <ul class="setting-option bg-transparent">
                        <li>
                          <div class="setting-badge light-badge"><i class="fa fa-cog"></i></div>
                        </li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-0">                              
                    <div class="help-desk text-center">
                      <div class="help-profile">
                        <div class="round-animation"><i></i><i></i></div><img class="img-fluid img-100" src="{{url('public/build/assets/backend/images/dashboard/mirage-delete.png')}}">
                      </div>
                      <h4 class="font-light">Have a any question</h4>
                      <p class="font-light">Lorem ipsum is simply dummy text of the printing and typesetting industry.</p><a class="btn btn-light" href="faq.html" data-original-title="" title="">Ask Question</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection