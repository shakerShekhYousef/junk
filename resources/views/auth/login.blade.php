@extends('layouts.front.base')
@section('pageTitle', 'Login')
@section('custom-style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <style type="text/css">
        #create-account {
            display: none;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6" style="padding-left: 0px !important;padding-right: 0px !important;">
                <div class="container form-contain">
                    <div class="row">
                        <div class="col-12">
                            <h1>Welcome to Junk!</h1>
                        </div>
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @if ($errors->has('email') || $errors->has('password'))
                            <span style="color: red">Invalid credinteals</span>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <label style="color: white">Email</label>
                                <input class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"
                                    name="email" required placeholder="Enter email address">
                                <br>
                                <label style="color: white">Password</label>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    type="password" name="password" placeholder="Enter password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input class="input-check" type="checkbox" id="Remember" name="remember"
                                    {{ old('remember') ? 'checked' : '' }} value="true">
                                <label for="Remember" style="color: white"> Remember me</label><br>
                            </div>
                            <div class="col-6 pt-2 mr-0">
                                <a style="color: white;" href="{{ route('password.request') }}">Forgot your
                                    password</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button style="cursor: 	pointer;" onclick="{{ route('login') }}">Log In</button>
                            </div>

                        </div>

                    </form>


                    <div class="row">
                        <div class="form-check col-md-6 col-12" style="padding: 2rem;/*margin-left: 1rem*/">
                            <input class="form-check-input" type="checkbox" value="" id="chkPassword"
                                onchange="valueChanged2()">
                            <label style="color: white; margin-top: 0!important" class="form-check-label"
                                for="chkPassword">Create account</label>
                        </div>
                    </div>

                    <div class="info-section" id="create-account">

                        <h1 style="font-family: 'Futura';text-transform: capitalize;"></h1>
                        <div class="reg-content">
                            <div class="container">
                                <form action="{{ route('web_small_create') }}" method="POST">
                                    @csrf
                                    <div class="form-reg-box">

                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">

                                                <input type="text" name="f-name" value="" class="form-control" required
                                                    placeholder="First name" />
                                            </div>
                                            <div class="form-group col-md-6 col-12">

                                                <input type="text" name="l-name" value="" class="form-control"
                                                    required placeholder="Last name" />
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12 col-12">

                                                <input type="text" name="name" value="" class="form-control" required
                                                    placeholder="Mobile number or email" />
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-12 col-md-12 col-12">

                                                <input type="password" name="password" class="form-control"
                                                    placeholder="New password" />

                                            </div>
                                        </div>

                                        <!--start birthday-->
                                        <label style="color: #fff;" for="birthday">Birthday:</label>

                                        <div class="row">
                                            <span class="col-lg-4 mb-3">
                                                <select name="month" class="form-control">
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </span>

                                            <span class="col-lg-4 mb-3">
                                                <select name="day" class="form-control">
                                                    <option value="01">1</option>
                                                    <option value="02">2</option>
                                                    <option value="03">3</option>
                                                    <option value="04">4</option>
                                                    <option value="05">5</option>
                                                    <option value="06">6</option>
                                                    <option value="07">7</option>
                                                    <option value="08">8</option>
                                                    <option value="09">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </span>

                                            <span class="col-lg-4 mb-3">
                                                <select name="year" class="form-control ">
                                                    <option value="2030">2030</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2000">2000</option>
                                                    <option value="1999">1999</option>
                                                    <option value="1998">1998</option>
                                                    <option value="1997">1997</option>
                                                    <option value="1996">1996</option>
                                                    <option value="1995">1995</option>
                                                    <option value="1994">1994</option>
                                                    <option value="1993">1993</option>
                                                    <option value="1992">1992</option>
                                                    <option value="1991">1991</option>
                                                    <option value="1990">1990</option>
                                                    <option value="1989">1989</option>
                                                    <option value="1988">1988</option>
                                                    <option value="1987">1987</option>
                                                    <option value="1986">1986</option>
                                                    <option value="1985">1985</option>
                                                    <option value="1984">1984</option>
                                                    <option value="1983">1983</option>
                                                    <option value="1982">1982</option>
                                                    <option value="1981">1981</option>
                                                    <option value="1980">1980</option>
                                                    <option value="1979">1979</option>
                                                    <option value="1978">1978</option>
                                                    <option value="1977">1977</option>
                                                    <option value="1976">1976</option>
                                                    <option value="1975">1975</option>
                                                    <option value="1974">1974</option>
                                                    <option value="1973">1973</option>
                                                    <option value="1972">1972</option>
                                                    <option value="1971">1971</option>
                                                    <option value="1970">1970</option>
                                                    <option value="1969">1969</option>
                                                    <option value="1968">1968</option>
                                                    <option value="1967">1967</option>
                                                    <option value="1966">1966</option>
                                                    <option value="1965">1965</option>
                                                    <option value="1964">1964</option>
                                                    <option value="1963">1963</option>
                                                    <option value="1962">1962</option>
                                                    <option value="1961">1961</option>
                                                    <option value="1960">1960</option>
                                                    <option value="1959">1959</option>
                                                    <option value="1958">1958</option>
                                                    <option value="1957">1957</option>
                                                    <option value="1956">1956</option>
                                                    <option value="1955">1955</option>
                                                    <option value="1954">1954</option>
                                                    <option value="1953">1953</option>
                                                    <option value="1952">1952</option>
                                                    <option value="1951">1951</option>
                                                    <option value="1950">1950</option>
                                                    <option value="1949">1949</option>
                                                    <option value="1948">1948</option>
                                                    <option value="1947">1947</option>
                                                    <option value="1946">1946</option>
                                                    <option value="1945">1945</option>
                                                    <option value="1944">1944</option>
                                                    <option value="1943">1943</option>
                                                    <option value="1942">1942</option>
                                                    <option value="1941">1941</option>
                                                    <option value="1940">1940</option>
                                                    <option value="1939">1939</option>
                                                    <option value="1938">1938</option>
                                                    <option value="1937">1937</option>
                                                    <option value="1936">1936</option>
                                                    <option value="1935">1935</option>
                                                    <option value="1934">1934</option>
                                                    <option value="1933">1933</option>
                                                    <option value="1932">1932</option>
                                                    <option value="1931">1931</option>
                                                    <option value="1930">1930</option>
                                                    <option value="1929">1929</option>
                                                    <option value="1928">1928</option>
                                                    <option value="1927">1927</option>
                                                    <option value="1926">1926</option>
                                                    <option value="1925">1925</option>
                                                    <option value="1924">1924</option>
                                                    <option value="1923">1923</option>
                                                    <option value="1922">1922</option>
                                                    <option value="1921">1921</option>
                                                    <option value="1920">1920</option>
                                                    <option value="1919">1919</option>
                                                    <option value="1918">1918</option>
                                                    <option value="1917">1917</option>
                                                    <option value="1916">1916</option>
                                                    <option value="1915">1915</option>
                                                    <option value="1914">1914</option>
                                                    <option value="1913">1913</option>
                                                    <option value="1912">1912</option>
                                                    <option value="1911">1911</option>
                                                    <option value="1910">1910</option>
                                                    <option value="1909">1909</option>
                                                    <option value="1908">1908</option>
                                                    <option value="1907">1907</option>
                                                    <option value="1906">1906</option>
                                                    <option value="1905">1905</option>
                                                    <option value="1904">1904</option>
                                                    <option value="1903">1903</option>
                                                    <option value="1902">1902</option>
                                                    <option value="1901">1901</option>
                                                    <option value="1900">1900</option>
                                                </select>
                                            </span>
                                        </div>

                                        <!--end birthday-->

                                        <div class="row" style="    align-items: baseline; padding: 2rem 0 0;">
                                            <div class="form-group col-lg-3 col-md-12 col-12"
                                                style="margin-bottom: 0!important">
                                                <label style="color: #fff" for="">Gender:</label>
                                            </div>
                                            <div class="form-group col-lg-4  col-md-6 col-6 text-center">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="gender" name="gender" value="1">
                                                    <label style="font-weight: 500;">Male</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 col-6 female-co">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="gender" name="gender" value="2">
                                                    <label style="font-weight: 500;">Female</label>

                                                </div>
                                            </div>




                                        </div>



                                        <p>By Sign Up, you agree to our Terms, data Policy and Cookies Policy
                                            <br>
                                            You may receive SMS Notifications from us
                                        </p>


                                        <div class="row">
                                            <div class="col-6">
                                                <button style="cursor:  pointer;" onclick="">create</button>
                                            </div>

                                        </div>



                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="col-12 col-lg-6" style="padding-left: 0px !important;padding-right: 0px !important;">
                <img src="{{ asset('assets/img/login/Component.jpg') }}" width="100%" id="image" style="height: 100%">
            </div>
        </div>





        <script type="text/javascript">
            function valueChanged2() {

                if ($('#chkPassword').is(":checked"))
                    $("#create-account").show();

                else
                    $("#create-account").hide();
            }
        </script>
    @endsection
