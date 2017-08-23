<?php
	$this->load->view('frontend/include/header');
?>

<section class="middle-container account-section profile-section">
    <div class="container">
        <div class="main-content">
            <div class="row clearfix">
                <aside class="col-lg-3 left-sidebar">
                    <div class="sidenav-list">
                        <ul>
                            <li class="active"><a href="<?php echo base_url()?>Profile">Edit Profile</a></li>
                            <li><a href="<?php echo base_url()?>Profile/Profile2">Photos and Video</a></li>
                            <li><a href="<?php echo base_url()?>Profile/Profile3">Trust and Verification</a></li>
                            <li><a href="<?php echo base_url()?>Profile/Profile4">Reviews</a></li>
                            <li><a href="<?php echo base_url()?>Profile/Profile5">References</a></li>
                        </ul>
                    </div>
                    <a class="btn btn-default btn-block" href="#">View Profile</a>
                </aside>
                <article class="col-lg-9 main-right">
                    <div class="panel-group">
                        <div class="panel panel-default required">
                            <div class="panel-heading">Required</div>
                            <div class="panel-body">
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">First Name</label>
                                        <div class="col-sm-9"><input class="textbox" type="text" /></div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Last Name</label>
                                        <div class="col-sm-9">
                                            <input class="textbox" type="text" />
                                            <p>Your public profile only shows your first name. When you request a booking, your host will see your first and last name.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">First Name <i class="fa fa-lock" aria-hidden="true"></i></label>
                                        <div class="col-sm-9">
                                            <select class="selectbox">
                                                <option selected="selected" value="">Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">First Name <i class="fa fa-lock" aria-hidden="true"></i></label>
                                        <div class="col-sm-9">
                                            <select class="selectbox">
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option selected="selected" value="12">December</option>
                                            </select>
                                            <select class="selectbox">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option selected="selected" value="12">12</option>
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
                                            <select class="selectbox">
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
                                                <option selected="selected" value="1989">1989</option>
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
                                            </select>
                                            <p>The magical day you were dropped from the sky by a stork. We use this data for analysis and never share it with other users.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Email Address <i class="fa fa-lock" aria-hidden="true"></i></label>
                                        <div class="col-sm-9">
                                            <input class="textbox" type="text" placeholder="abc@gmail.com" />
                                            <p>We won’t share your personal email address with other Pooln users.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Email Address <i class="fa fa-lock" aria-hidden="true"></i></label>
                                        <div class="col-sm-9 number-add">
                                            <p>No phone number entered.</p>
                                            <p><a href="#">+ Add a phone number</a></p>
                                            <p>This is only shared once you have a confirmed booking with another Got Saloon user. This is how we can all get in touch</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Preferred Language</label>
                                        <div class="col-sm-9">
                                            <select class="selectbox">
                                                <option value="id">Bahasa Indonesia</option>
                                                <option value="ms">Bahasa Melayu</option>
                                                <option value="ca">Català</option>
                                                <option value="da">Dansk</option>
                                                <option value="de">Deutsch</option>
                                                <option value="en" selected="selected">English</option>
                                                <option value="es">Español</option>
                                                <option value="el">Eλληνικά</option>
                                                <option value="fr">Français</option>
                                                <option value="it">Italiano</option>
                                                <option value="hu">Magyar</option>
                                                <option value="nl">Nederlands</option>
                                                <option value="no">Norsk</option>
                                                <option value="pl">Polski</option>
                                                <option value="pt">Português</option>
                                                <option value="fi">Suomi</option>
                                                <option value="sv">Svenska</option>
                                                <option value="tr">Türkçe</option>
                                                <option value="is">Íslenska</option>
                                                <option value="cs">Čeština</option>
                                                <option value="ru">Русский</option>
                                                <option value="th">ภาษาไทย</option>
                                                <option value="zh">中文 (简体)</option>
                                                <option value="zh-TW">中文 (繁體)</option>
                                                <option value="ja">日本語</option>
                                                <option value="ko">한국어</option>
                                            </select>
                                            <p>We'll send you messages in this language.</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Preferred Currency</label>
                                        <div class="col-sm-9">
                                            <select class="selectbox">
                                                <option value="AED">AED</option>
                                                <option value="ARS">ARS</option>
                                                <option value="AUD">AUD</option>
                                                <option value="BGN">BGN</option>
                                                <option value="BRL">BRL</option>
                                                <option value="CAD">CAD</option>
                                                <option value="CHF">CHF</option>
                                                <option value="CLP">CLP</option>
                                                <option value="CNY">CNY</option>
                                                <option value="COP">COP</option>
                                                <option value="CRC">CRC</option>
                                                <option value="CZK">CZK</option>
                                                <option value="DKK">DKK</option>
                                                <option value="EUR">EUR</option>
                                                <option value="GBP">GBP</option>
                                                <option value="HKD">HKD</option>
                                                <option value="HRK">HRK</option>
                                                <option value="HUF">HUF</option>
                                                <option value="IDR">IDR</option>
                                                <option value="ILS">ILS</option>
                                                <option value="INR">INR</option>
                                                <option value="JPY">JPY</option>
                                                <option value="KRW">KRW</option>
                                                <option value="MAD">MAD</option>
                                                <option value="MXN">MXN</option>
                                                <option value="MYR">MYR</option>
                                                <option value="NOK">NOK</option>
                                                <option value="NZD">NZD</option>
                                                <option value="PEN">PEN</option>
                                                <option value="PHP">PHP</option>
                                                <option value="PLN">PLN</option>
                                                <option value="RON">RON</option>
                                                <option value="RUB">RUB</option>
                                                <option value="SAR">SAR</option>
                                                <option value="SEK">SEK</option>
                                                <option value="SGD">SGD</option>
                                                <option value="THB">THB</option>
                                                <option value="TRY">TRY</option>
                                                <option value="TWD">TWD</option>
                                                <option value="UAH">UAH</option>
                                                <option value="USD" selected="selected">USD</option>
                                                <option value="UYU">UYU</option>
                                                <option value="VND">VND</option>
                                                <option value="ZAR">ZAR</option>
                                            </select>
                                            <p>We’ll show you prices in this currency.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Where You Live</label>
                                        <div class="col-sm-9">
                                            <input class="textbox" type="text" placeholder="" />
                                            <p>We won’t share your personal email address with other Pooln users.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Describe Yourself</label>
                                        <div class="col-sm-9 number-add">
                                            <textarea class="textarea"></textarea>
                                            <p>Help other people get to know you.</p>
                                            <p>Tell them what it’s like to have you as a renter or partner: What’s your style of doing business? how long have you been in the industry? What are your specialities?.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default required optional">
                            <div class="panel-heading">Optional</div>
                            <div class="panel-body">
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">School/Institution Attended</label>
                                        <div class="col-sm-9">
                                            <input class="textbox" type="text" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">License/Certificate Received</label>
                                        <div class="col-sm-9">
                                            <input class="textbox" type="text" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Time Zone</label>
                                        <div class="col-sm-9">
                                            <select class="selectbox">
                                                <option value=""></option>
                                                <option value="International Date Line West">(GMT-11:00) International Date Line West</option>
                                                <option value="Midway Island">(GMT-11:00) Midway Island</option>
                                                <option value="Samoa">(GMT-11:00) Samoa</option>
                                                <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                                <option value="Alaska">(GMT-09:00) Alaska</option>
                                                <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                                <option value="Tijuana">(GMT-08:00) Tijuana</option>
                                                <option value="Arizona">(GMT-07:00) Arizona</option>
                                                <option value="Chihuahua">(GMT-07:00) Chihuahua</option>
                                                <option value="Mazatlan">(GMT-07:00) Mazatlan</option>
                                                <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                                <option value="Central America">(GMT-06:00) Central America</option>
                                                <option value="Central Time (US &amp; Canada)">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                                <option value="Guadalajara">(GMT-06:00) Guadalajara</option>
                                                <option value="Mexico City">(GMT-06:00) Mexico City</option>
                                                <option value="Monterrey">(GMT-06:00) Monterrey</option>
                                                <option value="Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                                <option value="Bogota">(GMT-05:00) Bogota</option>
                                                <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                                <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                                <option value="Lima">(GMT-05:00) Lima</option>
                                                <option value="Quito">(GMT-05:00) Quito</option>
                                                <option value="Atlantic Time (Canada)">(GMT-04:00) Atlantic Time (Canada)</option>
                                                <option value="Caracas">(GMT-04:00) Caracas</option>
                                                <option value="Georgetown">(GMT-04:00) Georgetown</option>
                                                <option value="La Paz">(GMT-04:00) La Paz</option>
                                                <option value="Santiago">(GMT-04:00) Santiago</option>
                                                <option value="Newfoundland">(GMT-03:30) Newfoundland</option>
                                                <option value="Brasilia">(GMT-03:00) Brasilia</option>
                                                <option value="Buenos Aires">(GMT-03:00) Buenos Aires</option>
                                                <option value="Greenland">(GMT-03:00) Greenland</option>
                                                <option value="Mid-Atlantic">(GMT-02:00) Mid-Atlantic</option>
                                                <option value="Azores">(GMT-01:00) Azores</option>
                                                <option value="Cape Verde Is.">(GMT-01:00) Cape Verde Is.</option>
                                                <option value="Casablanca">(GMT+00:00) Casablanca</option>
                                                <option value="Dublin">(GMT+00:00) Dublin</option>
                                                <option value="Edinburgh">(GMT+00:00) Edinburgh</option>
                                                <option value="Lisbon">(GMT+00:00) Lisbon</option>
                                                <option value="London">(GMT+00:00) London</option>
                                                <option value="Monrovia">(GMT+00:00) Monrovia</option>
                                                <option value="UTC">(GMT+00:00) UTC</option>
                                                <option value="Amsterdam">(GMT+01:00) Amsterdam</option>
                                                <option value="Belgrade">(GMT+01:00) Belgrade</option>
                                                <option value="Berlin">(GMT+01:00) Berlin</option>
                                                <option value="Bern">(GMT+01:00) Bern</option>
                                                <option value="Bratislava">(GMT+01:00) Bratislava</option>
                                                <option value="Brussels">(GMT+01:00) Brussels</option>
                                                <option value="Budapest">(GMT+01:00) Budapest</option>
                                                <option value="Copenhagen">(GMT+01:00) Copenhagen</option>
                                                <option value="Ljubljana">(GMT+01:00) Ljubljana</option>
                                                <option value="Madrid">(GMT+01:00) Madrid</option>
                                                <option value="Paris">(GMT+01:00) Paris</option>
                                                <option value="Prague">(GMT+01:00) Prague</option>
                                                <option value="Rome">(GMT+01:00) Rome</option>
                                                <option value="Sarajevo">(GMT+01:00) Sarajevo</option>
                                                <option value="Skopje">(GMT+01:00) Skopje</option>
                                                <option value="Stockholm">(GMT+01:00) Stockholm</option>
                                                <option value="Vienna">(GMT+01:00) Vienna</option>
                                                <option value="Warsaw">(GMT+01:00) Warsaw</option>
                                                <option value="West Central Africa">(GMT+01:00) West Central Africa</option>
                                                <option value="Zagreb">(GMT+01:00) Zagreb</option>
                                                <option value="Athens">(GMT+02:00) Athens</option>
                                                <option value="Bucharest">(GMT+02:00) Bucharest</option>
                                                <option value="Cairo">(GMT+02:00) Cairo</option>
                                                <option value="Harare">(GMT+02:00) Harare</option>
                                                <option value="Helsinki">(GMT+02:00) Helsinki</option>
                                                <option value="Jerusalem">(GMT+02:00) Jerusalem</option>
                                                <option value="Kyiv">(GMT+02:00) Kyiv</option>
                                                <option value="Pretoria">(GMT+02:00) Pretoria</option>
                                                <option value="Riga">(GMT+02:00) Riga</option>
                                                <option value="Sofia">(GMT+02:00) Sofia</option>
                                                <option value="Tallinn">(GMT+02:00) Tallinn</option>
                                                <option value="Vilnius">(GMT+02:00) Vilnius</option>
                                                <option value="Baghdad">(GMT+03:00) Baghdad</option>
                                                <option value="Istanbul">(GMT+03:00) Istanbul</option>
                                                <option value="Kuwait">(GMT+03:00) Kuwait</option>
                                                <option value="Minsk">(GMT+03:00) Minsk</option>
                                                <option value="Moscow">(GMT+03:00) Moscow</option>
                                                <option value="Nairobi">(GMT+03:00) Nairobi</option>
                                                <option value="Riyadh">(GMT+03:00) Riyadh</option>
                                                <option value="St. Petersburg">(GMT+03:00) St. Petersburg</option>
                                                <option value="Volgograd">(GMT+03:00) Volgograd</option>
                                                <option value="Tehran">(GMT+03:30) Tehran</option>
                                                <option value="Abu Dhabi">(GMT+04:00) Abu Dhabi</option>
                                                <option value="Baku">(GMT+04:00) Baku</option>
                                                <option value="Muscat">(GMT+04:00) Muscat</option>
                                                <option value="Tbilisi">(GMT+04:00) Tbilisi</option>
                                                <option value="Yerevan">(GMT+04:00) Yerevan</option>
                                                <option value="Kabul">(GMT+04:30) Kabul</option>
                                                <option value="Ekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                                <option value="Islamabad">(GMT+05:00) Islamabad</option>
                                                <option value="Karachi">(GMT+05:00) Karachi</option>
                                                <option value="Tashkent">(GMT+05:00) Tashkent</option>
                                                <option value="Chennai">(GMT+05:30) Chennai</option>
                                                <option value="Kolkata">(GMT+05:30) Kolkata</option>
                                                <option value="Mumbai">(GMT+05:30) Mumbai</option>
                                                <option value="New Delhi">(GMT+05:30) New Delhi</option>
                                                <option value="Sri Jayawardenepura">(GMT+05:30) Sri Jayawardenepura</option>
                                                <option value="Kathmandu">(GMT+05:45) Kathmandu</option>
                                                <option value="Almaty">(GMT+06:00) Almaty</option>
                                                <option value="Astana">(GMT+06:00) Astana</option>
                                                <option value="Dhaka">(GMT+06:00) Dhaka</option>
                                                <option value="Urumqi">(GMT+06:00) Urumqi</option>
                                                <option value="Rangoon">(GMT+06:30) Rangoon</option>
                                                <option value="Bangkok">(GMT+07:00) Bangkok</option>
                                                <option value="Hanoi">(GMT+07:00) Hanoi</option>
                                                <option value="Jakarta">(GMT+07:00) Jakarta</option>
                                                <option value="Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                <option value="Novosibirsk">(GMT+07:00) Novosibirsk</option>
                                                <option value="Beijing">(GMT+08:00) Beijing</option>
                                                <option value="Chongqing">(GMT+08:00) Chongqing</option>
                                                <option value="Hong Kong">(GMT+08:00) Hong Kong</option>
                                                <option value="Irkutsk">(GMT+08:00) Irkutsk</option>
                                                <option value="Kuala Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                                <option value="Perth">(GMT+08:00) Perth</option>
                                                <option value="Singapore">(GMT+08:00) Singapore</option>
                                                <option value="Taipei">(GMT+08:00) Taipei</option>
                                                <option value="Ulaan Bataar">(GMT+08:00) Ulaan Bataar</option>
                                                <option value="Osaka">(GMT+09:00) Osaka</option>
                                                <option value="Sapporo">(GMT+09:00) Sapporo</option>
                                                <option value="Seoul">(GMT+09:00) Seoul</option>
                                                <option value="Tokyo">(GMT+09:00) Tokyo</option>
                                                <option value="Yakutsk">(GMT+09:00) Yakutsk</option>
                                                <option value="Adelaide">(GMT+09:30) Adelaide</option>
                                                <option value="Darwin">(GMT+09:30) Darwin</option>
                                                <option value="Brisbane">(GMT+10:00) Brisbane</option>
                                                <option value="Canberra">(GMT+10:00) Canberra</option>
                                                <option value="Guam">(GMT+10:00) Guam</option>
                                                <option value="Hobart">(GMT+10:00) Hobart</option>
                                                <option value="Melbourne">(GMT+10:00) Melbourne</option>
                                                <option value="Port Moresby">(GMT+10:00) Port Moresby</option>
                                                <option value="Sydney">(GMT+10:00) Sydney</option>
                                                <option value="Vladivostok">(GMT+10:00) Vladivostok</option>
                                                <option value="Magadan">(GMT+11:00) Magadan</option>
                                                <option value="New Caledonia">(GMT+11:00) New Caledonia</option>
                                                <option value="Solomon Is.">(GMT+11:00) Solomon Is.</option>
                                                <option value="Auckland">(GMT+12:00) Auckland</option>
                                                <option value="Fiji">(GMT+12:00) Fiji</option>
                                                <option value="Kamchatka">(GMT+12:00) Kamchatka</option>
                                                <option value="Marshall Is.">(GMT+12:00) Marshall Is.</option>
                                                <option value="Wellington">(GMT+12:00) Wellington</option>
                                                <option value="Nuku'alofa">(GMT+13:00) Nuku'alofa</option>
                                            </select>
                                            <p>Your home time zone.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Languages</label>
                                        <div class="col-sm-9 number-add">
                                            <p>None</p>
                                            <p><a href="#">+ Add More</a></p>
                                            <p>Add any languages that others can use to speak with you on Airbnb</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Emergency contact <i class="fa fa-lock" aria-hidden="true"></i></label>
                                        <div class="col-sm-9 number-add">
                                            <p><a href="#">+ Add More</a></p>
                                            <p>Give our Customer Experience team a trusted contact we can alert in an urgent situation.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-input">
                                    <div class="row">
                                        <label class="align-right col-sm-3">Shipping Address <i class="fa fa-lock" aria-hidden="true"></i></label>
                                        <div class="col-sm-9 number-add">
                                            <p><a href="#">+ Add shipping address</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn-red">Save</button>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
<?php
	$this->load->view('frontend/include/footer');
?>
<script type="text/javascript">
$(document).ready(function(){

});
</script>
</body>
</html>
