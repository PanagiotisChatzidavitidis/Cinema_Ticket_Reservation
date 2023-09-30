<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <?php
            require_once("common.php");
            session_start();
        ?>
    </head>
    <body>

        <header>
            <img src="images/popcorn.png" width="200"><div class="title">Cine-Zea</div>
        </header> 

        <!-- Navigation bar-->
        <div class="topnav">
              <a href="admin_cinemahome.php">Home</a>
              <a href="movies.php">Movies</a>
              <a href="screenings.php">Screenings</a>
              <a class="active" href="user_administration.php">User Administration</a>
              <a href="ticket.php">Ticket Administration</a>
              <a href="cinema_sign_out.php">Sign-out</a>
              
             
        </div>

        <!-- Display Users and Admins-->
        <div class='movies'>Users & Admins</div>
        
        <form method="post">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit" name="submit">Search</button>
        </form>
        <div class="container">
            <?php
                if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                    $sql="SELECT * FROM user WHERE user_trait != 'Unassigned' AND (user_username LIKE '%$search%' OR user_name LIKE '%$search%' OR user_lastname LIKE '%$search%' OR user_country LIKE '%$search%' OR user_city LIKE '%$search%' OR user_address LIKE '%$search%' OR user_email LIKE '%$search%' OR user_trait LIKE '%$search%')";
                } else {
                    $sql="SELECT * FROM user WHERE user_trait != 'Unassigned'";
                }
                $result=$conn->query($sql);
                if (!$result) die($conn->error);
                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                    echo "<div class='item'><br>"."Username: ".$row['user_username']." | "."Name: ".$row['user_name']." | "."Last name: ".$row['user_lastname']." | "."Country: ".$row['user_country']." | "."City: ".$row['user_city']." | "."Address: ".$row['user_address']." | "."E-mail: ".$row['user_email']." | "."Trait: ".$row['user_trait']."<br></div>";
                }
            ?>
        </div>

        <!-- Display Uncofirmed users-->
        <div class='movies'>Uncomfirmed Users</div>

        <form method="get">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>

        <div class="container">
            <?php
                $sql="SELECT * FROM user WHERE user_trait = 'Unassigned'";
                if(isset($_GET['search'])) {
                    $search = $conn->real_escape_string($_GET['search']);
                    $sql .= " AND (user_username LIKE '%$search%' OR user_name LIKE '%$search%' OR user_lastname LIKE '%$search%' OR user_country LIKE '%$search%' OR user_city LIKE '%$search%' OR user_address LIKE '%$search%' OR user_email LIKE '%$search%')";
                }
                $result=$conn->query($sql);
                
                if (!$result) die($conn->error);
                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                    echo "<div class='item'><br>"."Username: ".$row['user_username']." | "."Name: ".$row['user_name']." | "."Last name: ".$row['user_lastname']." | "."Country: ".$row['user_country']." | "."City: ".$row['user_city']." | "."Address: ".$row['user_address']." | "."E-mail: ".$row['user_email']." | "."Trait: ".$row['user_trait']."<br></div>";
                }
            ?> 
        </div>

        <!-- Trait Assigment-->
        <div class='movies'>Trait Assigment</div>

        <div class="container">  

            <form action="trait_assignment.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="user_username">Select User to assign trait</label> 
                    </div>
                    <div class="col-75">
                        <select id="user_username" name="user_username"> <!-- einai o user pou tha labei tin tropopoiisi -->
                            <?php
                                $sql='select * from user where user_trait="Unassigned"';
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                    echo "<option value='".$row['user_username']."'>".$row['user_username']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div> <div class="row">
                    <div class="col-25">
                        <label for="user_trait">Trait</label> 
                    </div>
                    <div class="col-75">
                        <select id="user_trait" name="user_trait">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        
                        </select>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Assign">
                </div>
            </form>
        </div>

        <!-- Create New User -->
        <div class='movies'>Create New User</div> 

        <div class="container">  
            <form action="create_account.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="user_username">Username</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_username" name="user_username" placeholder="Enter Username...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_name">Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_name" name="user_name" placeholder="Enter Name...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_lastname">Last name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_lastname" name="user_lastname" placeholder="Enter Last name...">
                    </div>
                </div>

                <div class="col-25">
                    <label for="user_country">Country</label>
                </div>
                <div class="col-75">
                    <select id="user_country" name="user_country">
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antartica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo">Congo, the Democratic Republic of the</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                        <option value="Croatia">Croatia (Hrvatska)</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="France Metropolitan">France, Metropolitan</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                        <option value="Holy See">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran (Islamic Republic of)</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon" selected>Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia">Micronesia, Federated States of</option>
                        <option value="Moldova">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                        <option value="Saint LUCIA">Saint LUCIA</option>
                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                        <option value="Span">Spain</option>
                        <option value="SriLanka">Sri Lanka</option>
                        <option value="St. Helena">St. Helena</option>
                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Viet Nam</option>
                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_city">City</label>
                    </div>
                    <div class="col-75">
                        <!-- Attica Region-->
                        <select id="user_city" name="user_city">
                            <option value="Acharnés">Acharnés</option>
                            <option value="Aegina">Aegina</option>
                            <option value="Afidnés">Afidnés</option>
                            <option value="Aghios Panteleímon">Aghios Panteleímon</option>
                            <option value="Agía Marína">Agía Marína</option>
                            <option value="Agía Paraskeví">Agía Paraskeví</option>
                            <option value="Agía Varvára">Agía Varvára</option>
                            <option value="Ágioi Anárgyroi">Ágioi Anárgyroi</option>
                            <option value="Agios Dimitrios">Agios Dimitrios</option>
                            <option value="Agios Dimítrios Kropiás">Agios Dimítrios Kropiás</option>
                            <option value="Agios Ioannis Rentis">Agios Ioannis Rentis</option>
                            <option value="Ágios Stéfanos">Ágios Stéfanos</option>
                            <option value="Aiánteio">Aiánteio</option>
                            <option value="Aigáleo">Aigáleo</option>
                            <option value="Álimos">Álimos</option>
                            <option value="Ampelákia">Ampelákia</option>
                            <option value="Anávyssos">Anávyssos</option>
                            <option value="Áno Liósia">Áno Liósia</option>
                            <option value="Anoixi">Anoixi</option>
                            <option value="Anthoúsa">Anthoúsa</option>
                            <option value="Argithéa">Argithéa</option>
                            <option value="Argyroúpoli">Argyroúpoli</option>
                            <option value="Artémida">Artémida</option>
                            <option value="Asprópyrgos">Asprópyrgos</option>
                            <option value="Athens">Athens</option>
                            <option value="Avlónas">Avlónas</option>
                            <option value="Áyioi Apóstoloi">Áyioi Apóstoloi</option>
                            <option value="Chaïdári">Chaïdári</option>
                            <option value="Cholargós">Cholargós</option>
                            <option value="Dhafní">Dhafní</option>
                            <option value="Dhráfi">Dhráfi</option>
                            <option value="Dióni">Dióni</option>
                            <option value="Diónysos">Diónysos</option>
                            <option value="Drapetsóna">Drapetsóna</option>
                            <option value="Drosiá">Drosiá</option>
                            <option value="Ekáli">Ekáli</option>
                            <option value="Elefsína">Elefsína</option>
                            <option value="Ellinikó">Ellinikó</option>
                            <option value="Erythrés">Erythrés</option>
                            <option value="Filothéi">Filothéi</option>
                            <option value="Fylí">Fylí</option>
                            <option value="Galatás">Galatás</option>
                            <option value="Galátsi">Galátsi</option>
                            <option value="Gérakas">Gérakas</option>
                            <option value="Glyfáda">Glyfáda</option>
                            <option value="Grammatikó">Grammatikó</option>
                            <option value="Ílion">Ílion</option>
                            <option value="Ilioúpoli">Ilioúpoli</option>
                            <option value="Irákleio">Irákleio</option>
                            <option value="Kaisarianí">Kaisarianí</option>
                            <option value="Kálamos">Kálamos</option>
                            <option value="Kallithéa">Kallithéa</option>
                            <option value="Kalývia Thorikoú">Kalývia Thorikoú</option>
                            <option value="Kamaterón">Kamaterón</option>
                            <option value="Kapandríti">Kapandríti</option>
                            <option value="Karellás">Karellás</option>
                            <option value="Káto Soúlion">Káto Soúlion</option>
                            <option value="Keratéa">Keratéa</option>
                            <option value="Keratsíni">Keratsíni</option>
                            <option value="Khalándrion">Khalándrion</option>
                            <option value="Khalkoútsion">Khalkoútsion</option>
                            <option value="Kifisiá">Kifisiá</option>
                            <option value="Kinéta">Kinéta</option>
                            <option value="Kipséli">Kipséli</option>
                            <option value="Kítsi">Kítsi</option>
                            <option value="Koropí">Koropí</option>
                            <option value="Korydallós">Korydallós</option>
                            <option value="Kouvarás">Kouvarás</option>
                            <option value="Kryonéri">Kryonéri</option>
                            <option value="Kypséli">Kypséli</option>
                            <option value="Kýthira">Kýthira</option>
                            <option value="Lávrio">Lávrio</option>
                            <option value="Leondárion">Leondárion</option>
                            <option value="Limín Mesoyaías">Limín Mesoyaías</option>
                            <option value="Lykóvrysi">Lykóvrysi</option>
                            <option value="Magoúla">Magoúla</option>
                            <option value="Mándra">Mándra</option>
                            <option value="Marathónas">Marathónas</option>
                            <option value="Markópoulo">Markópoulo</option>
                            <option value="Markópoulo Oropoú">Markópoulo Oropoú</option>
                            <option value="Maroúsi">Maroúsi</option>
                            <option value="Megalochóri">Megalochóri</option>
                            <option value="Mégara">Mégara</option>
                            <option value="Melíssia">Melíssia</option>
                            <option value="Metamórfosi">Metamórfosi</option>
                            <option value="Moskháton">Moskháton</option>
                            <option value="Néa Chalkidóna">Néa Chalkidóna</option>
                            <option value="Néa Erythraía">Néa Erythraía</option>
                            <option value="Néa Filadélfeia">Néa Filadélfeia</option>
                            <option value="Néa Ionía">Néa Ionía</option>
                            <option value="Néa Mákri">Néa Mákri</option>
                            <option value="Néa Palátia">Néa Palátia</option>
                            <option value="Néa Pentéli">Néa Pentéli</option>
                            <option value="Néa Péramos">Néa Péramos</option>
                            <option value="Néa Smýrni">Néa Smýrni</option>
                            <option value="Néo Psychikó">Néo Psychikó</option>
                            <option value="Neos Voutzás">Neos Voutzás</option>
                            <option value="Níkaia">Níkaia</option>
                            <option value="Oropós">Oropós</option>
                            <option value="Paianía">Paianía</option>
                            <option value="Palaiá Fókaia">Palaiá Fókaia</option>
                            <option value="Palaió Fáliro">Palaió Fáliro</option>
                            <option value="Pallíni">Pallíni</option>
                            <option value="Papágou">Papágou</option>
                            <option value="Péfki">Péfki</option>
                            <option value="Pentéli">Pentéli</option>
                            <option value="Pérama">Pérama</option>
                            <option value="Peristéri">Peristéri</option>
                            <option value="Petroúpolis">Petroúpolis</option>
                            <option value="Pikérmi">Pikérmi</option>
                            <option value="Piraeus">Piraeus</option>
                            <option value="Polydéndri">Polydéndri</option>
                            <option value="Póros">Póros</option>
                            <option value="Psychikó">Psychikó</option>
                            <option value="Rafína">Rafína</option>
                            <option value="Rodópoli">Rodópoli</option>
                            <option value="Salamína">Salamína</option>
                            <option value="Saronída">Saronída</option>
                            <option value="Selínia">Selínia</option>
                            <option value="Skála Oropoú">Skála Oropoú</option>
                            <option value="Skarmagkás">Skarmagkás</option>
                            <option value="Spáta">Spáta</option>
                            <option value="Spétses">Spétses</option>
                            <option value="Stamáta">Stamáta</option>
                            <option value="Távros">Távros</option>
                            <option value="Thrakomakedónes">Thrakomakedónes</option>
                            <option value="Vári">Vári</option>
                            <option value="Varnávas">Varnávas</option>
                            <option value="Varybóbi">Varybóbi</option>
                            <option value="Vathý">Vathý</option>
                            <option value="Vília">Vília</option>
                            <option value="Vlycháda">Vlycháda</option>
                            <option value="Voúla">Voúla</option>
                            <option value="Vouliagméni">Vouliagméni</option>
                            <option value="Vraná">Vraná</option>
                            <option value="Vrilissia">Vrilissia</option>
                            <option value="Výronas">Výronas</option>
                            <option value="Ýdra">Ýdra</option>
                            <option value="Ymittos">Ymittos</option>
                            <option value="Zefyri">Zefyri</option>
                            <option value="Zográfos">Zográfos</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_address">Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_address" name="user_address" placeholder="Enter Address...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_email">E-mail</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_email" name="user_email" placeholder="Enter E-mail...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="user_password" name="user_password" placeholder="Enter Password...">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="user_password">Confirm Password</label> 
                    </div>
                    <div class="col-75">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter Password...">
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="Create Account">
                </div>
            </form>
           
        </div>

        <!-- Update User -->
        <div class='movies'>Update Existing User</div>  

        <div class="container">  
            <form action="update_account.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="user_username">Select User to Update</label>
                    </div>
                    <div class="col-75">
                        <select id="user_username" name="user_username_edit"> <!-- einai i timi pou elexete gia to update -->
                            <?php
                                $sql='SELECT * FROM user WHERE user_trait="Admin" OR user_trait="User"';
                                $result=$conn->query($sql);
                                if (!$result) die($conn->error);
                                while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                echo "<option value='".$row['user_username']."'>".$row['user_username']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="user_username">Username</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_username" name="user_username" placeholder="Enter Username...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_name">Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_name" name="user_name" placeholder="Enter Name...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_lastname">Last name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_lastname" name="user_lastname" placeholder="Enter Last name...">
                    </div>
                </div>

                <div class="col-25">
                    <label for="user_country">Country</label>
                </div>
                <div class="col-75">
                    <select id="user_country" name="user_country">
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antartica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo">Congo, the Democratic Republic of the</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                        <option value="Croatia">Croatia (Hrvatska)</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="France Metropolitan">France, Metropolitan</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                        <option value="Holy See">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran (Islamic Republic of)</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon" selected>Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia">Micronesia, Federated States of</option>
                        <option value="Moldova">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                        <option value="Saint LUCIA">Saint LUCIA</option>
                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                        <option value="Span">Spain</option>
                        <option value="SriLanka">Sri Lanka</option>
                        <option value="St. Helena">St. Helena</option>
                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Viet Nam</option>
                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_city">City</label>
                    </div>
                    <div class="col-75">
                        <!-- Attica Region-->
                        <select id="user_city" name="user_city">
                            <option value="Acharnés">Acharnés</option>
                            <option value="Aegina">Aegina</option>
                            <option value="Afidnés">Afidnés</option>
                            <option value="Aghios Panteleímon">Aghios Panteleímon</option>
                            <option value="Agía Marína">Agía Marína</option>
                            <option value="Agía Paraskeví">Agía Paraskeví</option>
                            <option value="Agía Varvára">Agía Varvára</option>
                            <option value="Ágioi Anárgyroi">Ágioi Anárgyroi</option>
                            <option value="Agios Dimitrios">Agios Dimitrios</option>
                            <option value="Agios Dimítrios Kropiás">Agios Dimítrios Kropiás</option>
                            <option value="Agios Ioannis Rentis">Agios Ioannis Rentis</option>
                            <option value="Ágios Stéfanos">Ágios Stéfanos</option>
                            <option value="Aiánteio">Aiánteio</option>
                            <option value="Aigáleo">Aigáleo</option>
                            <option value="Álimos">Álimos</option>
                            <option value="Ampelákia">Ampelákia</option>
                            <option value="Anávyssos">Anávyssos</option>
                            <option value="Áno Liósia">Áno Liósia</option>
                            <option value="Anoixi">Anoixi</option>
                            <option value="Anthoúsa">Anthoúsa</option>
                            <option value="Argithéa">Argithéa</option>
                            <option value="Argyroúpoli">Argyroúpoli</option>
                            <option value="Artémida">Artémida</option>
                            <option value="Asprópyrgos">Asprópyrgos</option>
                            <option value="Athens">Athens</option>
                            <option value="Avlónas">Avlónas</option>
                            <option value="Áyioi Apóstoloi">Áyioi Apóstoloi</option>
                            <option value="Chaïdári">Chaïdári</option>
                            <option value="Cholargós">Cholargós</option>
                            <option value="Dhafní">Dhafní</option>
                            <option value="Dhráfi">Dhráfi</option>
                            <option value="Dióni">Dióni</option>
                            <option value="Diónysos">Diónysos</option>
                            <option value="Drapetsóna">Drapetsóna</option>
                            <option value="Drosiá">Drosiá</option>
                            <option value="Ekáli">Ekáli</option>
                            <option value="Elefsína">Elefsína</option>
                            <option value="Ellinikó">Ellinikó</option>
                            <option value="Erythrés">Erythrés</option>
                            <option value="Filothéi">Filothéi</option>
                            <option value="Fylí">Fylí</option>
                            <option value="Galatás">Galatás</option>
                            <option value="Galátsi">Galátsi</option>
                            <option value="Gérakas">Gérakas</option>
                            <option value="Glyfáda">Glyfáda</option>
                            <option value="Grammatikó">Grammatikó</option>
                            <option value="Ílion">Ílion</option>
                            <option value="Ilioúpoli">Ilioúpoli</option>
                            <option value="Irákleio">Irákleio</option>
                            <option value="Kaisarianí">Kaisarianí</option>
                            <option value="Kálamos">Kálamos</option>
                            <option value="Kallithéa">Kallithéa</option>
                            <option value="Kalývia Thorikoú">Kalývia Thorikoú</option>
                            <option value="Kamaterón">Kamaterón</option>
                            <option value="Kapandríti">Kapandríti</option>
                            <option value="Karellás">Karellás</option>
                            <option value="Káto Soúlion">Káto Soúlion</option>
                            <option value="Keratéa">Keratéa</option>
                            <option value="Keratsíni">Keratsíni</option>
                            <option value="Khalándrion">Khalándrion</option>
                            <option value="Khalkoútsion">Khalkoútsion</option>
                            <option value="Kifisiá">Kifisiá</option>
                            <option value="Kinéta">Kinéta</option>
                            <option value="Kipséli">Kipséli</option>
                            <option value="Kítsi">Kítsi</option>
                            <option value="Koropí">Koropí</option>
                            <option value="Korydallós">Korydallós</option>
                            <option value="Kouvarás">Kouvarás</option>
                            <option value="Kryonéri">Kryonéri</option>
                            <option value="Kypséli">Kypséli</option>
                            <option value="Kýthira">Kýthira</option>
                            <option value="Lávrio">Lávrio</option>
                            <option value="Leondárion">Leondárion</option>
                            <option value="Limín Mesoyaías">Limín Mesoyaías</option>
                            <option value="Lykóvrysi">Lykóvrysi</option>
                            <option value="Magoúla">Magoúla</option>
                            <option value="Mándra">Mándra</option>
                            <option value="Marathónas">Marathónas</option>
                            <option value="Markópoulo">Markópoulo</option>
                            <option value="Markópoulo Oropoú">Markópoulo Oropoú</option>
                            <option value="Maroúsi">Maroúsi</option>
                            <option value="Megalochóri">Megalochóri</option>
                            <option value="Mégara">Mégara</option>
                            <option value="Melíssia">Melíssia</option>
                            <option value="Metamórfosi">Metamórfosi</option>
                            <option value="Moskháton">Moskháton</option>
                            <option value="Néa Chalkidóna">Néa Chalkidóna</option>
                            <option value="Néa Erythraía">Néa Erythraía</option>
                            <option value="Néa Filadélfeia">Néa Filadélfeia</option>
                            <option value="Néa Ionía">Néa Ionía</option>
                            <option value="Néa Mákri">Néa Mákri</option>
                            <option value="Néa Palátia">Néa Palátia</option>
                            <option value="Néa Pentéli">Néa Pentéli</option>
                            <option value="Néa Péramos">Néa Péramos</option>
                            <option value="Néa Smýrni">Néa Smýrni</option>
                            <option value="Néo Psychikó">Néo Psychikó</option>
                            <option value="Neos Voutzás">Neos Voutzás</option>
                            <option value="Níkaia">Níkaia</option>
                            <option value="Oropós">Oropós</option>
                            <option value="Paianía">Paianía</option>
                            <option value="Palaiá Fókaia">Palaiá Fókaia</option>
                            <option value="Palaió Fáliro">Palaió Fáliro</option>
                            <option value="Pallíni">Pallíni</option>
                            <option value="Papágou">Papágou</option>
                            <option value="Péfki">Péfki</option>
                            <option value="Pentéli">Pentéli</option>
                            <option value="Pérama">Pérama</option>
                            <option value="Peristéri">Peristéri</option>
                            <option value="Petroúpolis">Petroúpolis</option>
                            <option value="Pikérmi">Pikérmi</option>
                            <option value="Piraeus">Piraeus</option>
                            <option value="Polydéndri">Polydéndri</option>
                            <option value="Póros">Póros</option>
                            <option value="Psychikó">Psychikó</option>
                            <option value="Rafína">Rafína</option>
                            <option value="Rodópoli">Rodópoli</option>
                            <option value="Salamína">Salamína</option>
                            <option value="Saronída">Saronída</option>
                            <option value="Selínia">Selínia</option>
                            <option value="Skála Oropoú">Skála Oropoú</option>
                            <option value="Skarmagkás">Skarmagkás</option>
                            <option value="Spáta">Spáta</option>
                            <option value="Spétses">Spétses</option>
                            <option value="Stamáta">Stamáta</option>
                            <option value="Távros">Távros</option>
                            <option value="Thrakomakedónes">Thrakomakedónes</option>
                            <option value="Vári">Vári</option>
                            <option value="Varnávas">Varnávas</option>
                            <option value="Varybóbi">Varybóbi</option>
                            <option value="Vathý">Vathý</option>
                            <option value="Vília">Vília</option>
                            <option value="Vlycháda">Vlycháda</option>
                            <option value="Voúla">Voúla</option>
                            <option value="Vouliagméni">Vouliagméni</option>
                            <option value="Vraná">Vraná</option>
                            <option value="Vrilissia">Vrilissia</option>
                            <option value="Výronas">Výronas</option>
                            <option value="Ýdra">Ýdra</option>
                            <option value="Ymittos">Ymittos</option>
                            <option value="Zefyri">Zefyri</option>
                            <option value="Zográfos">Zográfos</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_address">Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_address" name="user_address" placeholder="Enter Address...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_email">E-mail</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user_email" name="user_email" placeholder="Enter E-mail...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_password">Password</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="user_password" name="user_password" placeholder="Enter Password...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="user_trait">Trait</label> 
                    </div>
                    <div class="col-75">
                        <select id="user_trait" name="user_trait">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <input type="submit" value="Update Account">
                </div>
            </form>   
        
        </div>
        

        <!-- Delete  User -->
        <div class='movies'>Delete User</div>
        
        <div class="container">
            <form action="delete_account.php" method="post">
                <div class="row">
                    <div class="col-25">
                        <label for="user_username">Select user to DELETE</label>
                    </div>
                    <div class="col-75">
                        <select id="user_username" name="user_username">
                            <?php
                                $sql='select * from user';
                                    $result=$conn->query($sql);
                                    if (!$result) die($conn->error);
                                    while ($row=$result->fetch_array(MYSQLI_ASSOC)){
                                        echo "<option value='".$row['user_username']."'>".$row['user_username']."</option>";
                                    }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Delete">
                </div>
        
            </form>
        </div>

         


        <footer>
            Copyright
        </footer>
    </body>
<html>