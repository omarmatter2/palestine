<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Virtual State of Palestine</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    <div class="vps-page">
        <div class="vps-bg">
            <!-- <video class="video-bg" src=""></video> -->
            <img class="video-bg" src="{{asset('assets/img/video-bg.svg')}}" />
        </div>
        <div class="vps-content">
            <div class="container">
                <div class="sub-container">

                    <div class="vps-header">
                        <img src="{{asset('assets/img/logo-w.svg')}}" />
                    </div>

                    <div class="vps-body">
                        <h1><strong>14</strong> million Palestinians have been forcibly displaced.</h1>
                        <h2>The number of individuals recognizing the establishment of a virtual Palestinian state.</h2>
                        <span class="vps-num">{{$counts}}</span>
                        <div class="vps-details">
                            <ul class="list-unstyled">
                                <li>
                                    <img src="{{asset('assets/img/australia.svg')}}" alt="" />
                                </li>
                                <li>
                                    <img src="{{asset('assets/img/belgium.svg')}}" alt="" />
                                </li>
                                <li>
                                    <img src="{{asset('assets/img/finland.svg')}}" alt="" />
                                </li>
                                <li>
                                    <img src="{{asset('assets/img/canada.svg')}}" alt="" />
                                </li>
                            </ul>


                            <!-- Button trigger modal -->
                            <button type="button" class="btn more-btn" data-bs-toggle="modal"
                                data-bs-target="#vpsCountriesVotesModal">
                                VIEW DETAILS >>
                            </button>

                        </div>

                        <form action="#" class="voting-form">


                            <input class="form-control" name="fullname" type="text" placeholder="Full Name">
                            <input class="form-control" name="email" type="email" placeholder="Email Address">

                            <select class="form-select selectCountry" name="country">
                               @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->getCommonName()}}</option>

                               @endforeach
                            </select>
                            <button type="submit" class="btn vote-btn"

                            >Vote</button>

                        </form>
                    </div>

                    <div class="vps-footer">

                        <p>Support us on social media</p>
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://www.facebook.com/profile.php?id=61571668951442">
                                    <img src="{{asset('assets/img/social-fb.svg')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/vspal48?igsh=NTd4czFlbjd0ZDZo&utm_source=qr">
                                    <img src="{{asset('assets/img/social-insta.svg')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://x.com/state46854">
                                    <img src="{{asset('assets/img/social-x.svg')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="www.tiktok.com/@vspal48">
                                    <img src="{{asset('assets/img/social-tiktok.svg')}}" alt="">
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- countries modal Modal -->
    <div class="modal fade voted-countries" id="vpsCountriesVotesModal" tabindex="-1"
        aria-labelledby="vpsCountriesVotesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                    <h2>The list of recognizing countries.</h2>
                    <p>The list of countries that have recognized the virtual State of
                        Palestine.</p>

                    <ul class="list-unstyled">
                        @foreach($votes as $vote)
                            <li>
                                <div class="country-name">
                                    <div class="flag">
                                        <img src="{{$vote['country']->getFlagUrl()}}" alt="">
                                    </div>
                                    <p>
                                        {{$vote['country']->getCommonName()}}
                                    </p>
                                </div>
                                <p>
                                    {{$vote['vote_count']}}
                                </p>
                            </li>
                        @endforeach


                    </ul>

                    <div class="hide-container">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hide</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- done modal -->



    <!-- Modal -->
    <div class="modal fade success-modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <span class="close-modal" data-bs-dismiss="modal" aria-label="Close"></span>

                    <span class="success-icon"></span>
                    <h3>
                        Thank you for your vote and for standing by us.
                    </h3>
                    <p>
                        Together, we can achieve the recognition of the virtual State of Palestine.
                    </p>

                    <div class="success-footer">
                        <p>Join us on social media</p>
                        <ul class="list-unstyled">
                            <li>
                                <a href="https://www.facebook.com/profile.php?id=61571668951442">
                                    <img src="{{asset('assets/img/social-fb.svg')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/vspal48?igsh=NTd4czFlbjd0ZDZo&utm_source=qr">
                                    <img src="{{asset('assets/img/social-insta.svg')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="https://x.com/state46854">
                                    <img src="{{asset('assets/img/social-x.svg')}}" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="www.tiktok.com/@vspal48">
                                    <img src="{{asset('assets/img/social-tiktok.svg')}}" alt="">
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.vote-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var data = form.serialize();
            // crsf token
            data += '&_token={{csrf_token()}}';
            $.ajax({
                url: '{{route('vote')}}',
                type: 'POST',
                data: data,
                success: function(response) {
                    $('#message').html(response.message);
                    $('#successModal').modal('show');
                },
                error: function(response) {
                    $('#message').html(response.responseJSON.message);
                    $('#exampleModal').modal('show');
                }
            });
        });
    });
</script>
</body>

</html>
