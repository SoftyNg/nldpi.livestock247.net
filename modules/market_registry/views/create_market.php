<div class="content-wrapper">
    <div class="container-fluid">
        <div class="animal-form-name mb-5">
            <h5 class="h3 mb-0 ml-4">Register Livestock Market</h5>
            <p class="pl-4 mt-1"></p>
        </div>
     
        <div class="register-animal-form my-4 px-4">
            <?php echo form_open($form_location);?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                         
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Name',
                                    'required' => true
                                ];
                                echo form_label('Market Name');
                                echo form_input('name', '',  $attr1);
                            ?>
                            <span class="text-danger"><?php  echo (!empty(validation_errors('name')) ? validation_errors('name') : ''); ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Livestock Type',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('State');
                                ?>
                              <select id="state" name="state" class="form-control" required>
    <option value="">-- Select State --</option>
</select>

                        </div>
                    </div> 
                </div>
                <div class="row">
  
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];

                                echo form_label('LGA');
                                ?>
                       <select id="lga" name="lga" class="form-control" required>
    <option value="">-- Select LGA --</option>
</select>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Market Address',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Address');
                                echo form_input('address', '',  $attr1);
                            ?>
                            <span class="text-danger">
                              
                        </div>
                    </div>   
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Longitude',
                                    'required' => true,
                                    'step' => 0.000001,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Longitude');
                                echo form_number('longitude', '',  $attr1);
                            ?>
                           
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                       
                             
                                <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Latitude',
                                    'required' => true,
                                    
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Latitude');
                                echo form_number('latitude', '',  $attr1);
                            ?>
                            
                          </div>

                    </div>   
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
    <label for="operating_days">Operating days</label>
    <select name="operating_days[]" id="" multiple class="form-control" required>
        <?php
        $options = ['Sundays', 'Mondays', 'Tuesdays', 'Wednesdays', 'Thursdays','Fridays','Saturdays'];
        $selected = (post('operating_days')) ? post('operating_days') : [];


        foreach ($options as $option) {
            $is_selected = in_array($option, $selected) ? 'selected' : '';
            echo "<option value=\"$option\" $is_selected>$option</option>";
        }
        ?>
    </select>
    <small class="form-text text-muted">Hold Ctrl (or Cmd on Mac) to select multiple.</small>
</div>

                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">                    
                             
                                <?php
                                echo form_label('Types of livestocks traded');                            
                            ?>
                             <select name="livestock_types[]" id="" multiple class="form-control" required>
        <?php
        $options = ['Cow', 'Goat', 'Sheep', 'Turkey', 'Chicken'];
        $selected = (post('livestock_types')) ? post('livestock_types') : [];


        foreach ($options as $option) {
            $is_selected = in_array($option, $selected) ? 'selected' : '';
            echo "<option value=\"$option\" $is_selected>$option</option>";
        }
        ?>
    </select>
    <small class="form-text text-muted">Hold Ctrl (or Cmd on Mac) to select multiple.</small>
                            
                            <span class="text-danger"><?php  echo (!empty(validation_errors('picture')) ? validation_errors('picture') : ''); ?></span>
                        </div>

                    </div>   
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <?php
                                echo form_label('Major breeds found');
                            
                            ?>
                             <select name="major_breeds[]" id="" multiple class="form-control" required>
        <?php
        $breed_list = Modules::run('breed_registrations/_get_breed_list');
     
        $selected = (post('major_breeds')) ? post('major_breeds') : [];


        foreach ($breed_list as $option) {
            $is_selected = in_array($option, $selected) ? 'selected' : '';
            echo "<option value=\"$option\" $is_selected>$option</option>";
        }
        ?>
    </select>
    <small class="form-text text-muted">Hold Ctrl (or Cmd on Mac) to select multiple.</small>
                               </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                       
                             
                                <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Latitude',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Ownership');

                               
                            ?>
                                     <select name="ownership" id="" class="form-control">
    <?php
    $options = ['Private', 'Government'];
    $selected = post('ownership') ?? ''; // retain selected value on post

    foreach ($options as $option) {
        $is_selected = ($option === $selected) ? 'selected' : '';
        echo "<option value=\"$option\" $is_selected>$option</option>";
    }
    ?>
</select>
                            
                   </div>

                    </div>   
                </div>
                
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Email',
                                    'required' => true,
                                    'autocomplete' => 'off'
                                ];
                                echo form_label('Email');
                                echo form_input('email', '',  $attr1);
                            ?>
                             </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                       
                             
                                <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'required' => true,
                                    'placeholder' => 'Enter phone'
                                ];
                                echo form_label('Phone Number');
                                echo form_input('phone', '',  $attr1);
                            ?>
                             </div>

                    </div>   
                </div>
                 <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'if any...'
                                ];
                                echo form_label('Website');
                                echo form_input('website', '',  $attr1);
                            ?>
                             </div>
                    </div> 
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                       
                             
                                <?php

$attr1 = [
    'class' => 'form-control',
    'placeholder' => 'Market Leader'
];
                                echo form_label('Market Leader');
                                echo form_input('market_leader', '',  $attr1);
                             
                            ?>
                   
                            
                            <span class="text-danger"><?php  echo (!empty(validation_errors('picture')) ? validation_errors('picture') : ''); ?></span>
                        </div>

                    </div>   
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'if any...'
                                ];
                                echo form_label('Security threat ');
                                  ?>
                                </br>
                                <?php
                                echo form_checkbox('security', 1,  $attr1);
                                
                            ?>
                             </div>
                            </div>
                               <div class="col">
                               <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'if any...'
                                ];
                                echo form_label('Vet Services ');
                                  ?>
                                </br>
                                <?php
                                echo form_checkbox('vet_services', 1,  $attr1);
                            ?>
                             </div>
                            </div>
                             <div class="col">

                               <div class="form-group">
                        <?php
                                $attr1 = [
                                    'class' => 'form-control',
                                    'placeholder' => 'if any...'
                                ];
                                echo form_label('Banking Service ');
                                ?>
                                </br>
                                <?php
                                echo form_checkbox('bank', 1,  $attr1);
                            ?>
                             </div>
                            </div>
                     
                </div>
                <hr>
                <div class="form-footer d-flex justify-content-between"> 
                    <div>
                        <?php
                        $btn_cancel_attr = [
                            'class' => 'btn btn-outline-dark'
                        ];
                        echo anchor('#', 'Back', $btn_cancel_attr);
                        ?>
                    </div>
                    <div id="step1Buttons" class="step-buttons d-flex flex-row"> 
                        <?php
                        $btn_submit_application_attr = [
                            'class' => 'btn btn-success'
                        ];
                        echo form_submit('submit','Register Market', $btn_submit_application_attr);
                        ?>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const statesAndLGAs = {
  "Abia": ["Aba North", "Aba South", "Arochukwu", "Bende", "Ikwuano", "Isiala Ngwa North", "Isiala Ngwa South", "Isuikwuato", "Obi Ngwa", "Ohafia", "Osisioma", "Ugwunagbo", "Ukwa East", "Ukwa West", "Umuahia North", "Umuahia South", "Umu Nneochi"],
  "Adamawa": ["Demsa", "Fufore", "Ganye", "Girei", "Gombi", "Guyuk", "Hong", "Jada", "Lamurde", "Madagali", "Maiha", "Mayo-Belwa", "Michika", "Mubi North", "Mubi South", "Numan", "Shelleng", "Song", "Toungo", "Yola North", "Yola South"],
  "Akwa Ibom": ["Abak", "Eastern Obolo", "Eket", "Esit Eket", "Essien Udim", "Etim Ekpo", "Etinan", "Ibeno", "Ibesikpo Asutan", "Ibiono Ibom", "Ika", "Ikono", "Ikot Abasi", "Ikot Ekpene", "Ini", "Itu", "Mbo", "Mkpat Enin", "Nsit Atai", "Nsit Ibom", "Nsit Ubium", "Obot Akara", "Okobo", "Onna", "Oron", "Oruk Anam", "Udung Uko", "Ukanafun", "Uruan", "Urue-Offong/Oruko", "Uyo"],
  "Anambra": ["Aguata", "Anambra East", "Anambra West", "Anaocha", "Awka North", "Awka South", "Ayamelum", "Dunukofia", "Ekwusigo", "Idemili North", "Idemili South", "Ihiala", "Njikoka", "Nnewi North", "Nnewi South", "Ogbaru", "Onitsha North", "Onitsha South", "Orumba North", "Orumba South", "Oyi"],
  "Bauchi": ["Alkaleri", "Bauchi", "Bogoro", "Damban", "Darazo", "Dass", "Gamawa", "Ganjuwa", "Giade", "Itas/Gadau", "Jama'are", "Katagum", "Kirfi", "Misau", "Ningi", "Shira", "Tafawa Balewa", "Toro", "Warji", "Zaki"],
  "Bayelsa": ["Brass", "Ekeremor", "Kolokuma/Opokuma", "Nembe", "Ogbia", "Sagbama", "Southern Ijaw", "Yenagoa"],
  "Benue": ["Ado", "Agatu", "Apa", "Buruku", "Gboko", "Guma", "Gwer East", "Gwer West", "Katsina-Ala", "Konshisha", "Kwande", "Logo", "Makurdi", "Obi", "Ogbadibo", "Ohimini", "Oju", "Okpokwu", "Otukpo", "Tarka", "Ukum", "Ushongo", "Vandeikya"],
  "Borno": ["Abadam", "Askira/Uba", "Bama", "Bayo", "Biu", "Chibok", "Damboa", "Dikwa", "Gubio", "Guzamala", "Gwoza", "Hawul", "Jere", "Kaga", "Kala/Balge", "Konduga", "Kukawa", "Kwaya Kusar", "Mafa", "Magumeri", "Maiduguri", "Marte", "Mobbar", "Monguno", "Ngala", "Nganzai", "Shani"],
  "Cross River": ["Abi", "Akamkpa", "Akpabuyo", "Bakassi", "Bekwarra", "Biase", "Boki", "Calabar Municipal", "Calabar South", "Etung", "Ikom", "Obanliku", "Obubra", "Obudu", "Odukpani", "Ogoja", "Yakurr", "Yala"],
  "Delta": ["Aniocha North", "Aniocha South", "Bomadi", "Burutu", "Ethiope East", "Ethiope West", "Ika North East", "Ika South", "Isoko North", "Isoko South", "Ndokwa East", "Ndokwa West", "Okpe", "Oshimili North", "Oshimili South", "Patani", "Sapele", "Udu", "Ughelli North", "Ughelli South", "Ukwuani", "Uvwie", "Warri North", "Warri South", "Warri South West"],
  "Ebonyi": ["Abakaliki", "Afikpo North", "Afikpo South", "Ebonyi", "Ezza North", "Ezza South", "Ikwo", "Ishielu", "Ivo", "Izzi", "Ohaozara", "Ohaukwu", "Onicha"],
  "Edo": ["Akoko-Edo", "Egor", "Esan Central", "Esan North-East", "Esan South-East", "Esan West", "Etsako Central", "Etsako East", "Etsako West", "Igueben", "Ikpoba-Okha", "Oredo", "Orhionmwon", "Ovia North-East", "Ovia South-West", "Owan East", "Owan West", "Uhunmwonde"],
  "Ekiti": ["Ado Ekiti", "Efon", "Ekiti East", "Ekiti South-West", "Ekiti West", "Emure", "Gbonyin", "Ido Osi", "Ijero", "Ikere", "Ikole", "Ilejemeje", "Irepodun/Ifelodun", "Ise/Orun", "Moba", "Oye"],
  "Enugu": ["Aninri", "Awgu", "Enugu East", "Enugu North", "Enugu South", "Ezeagu", "Igbo Etiti", "Igbo Eze North", "Igbo Eze South", "Isi Uzo", "Nkanu East", "Nkanu West", "Nsukka", "Oji River", "Udenu", "Udi", "Uzo Uwani"],
  "Gombe": ["Akko", "Balanga", "Billiri", "Dukku", "Funakaye", "Gombe", "Kaltungo", "Kwami", "Nafada", "Shongom", "Yamaltu/Deba"],
  "Imo": ["Aboh Mbaise", "Ahiazu Mbaise", "Ehime Mbano", "Ezinihitte", "Ideato North", "Ideato South", "Ihitte/Uboma", "Ikeduru", "Isiala Mbano", "Isu", "Mbaitoli", "Ngor Okpala", "Njaba", "Nkwerre", "Nwangele", "Obowo", "Oguta", "Ohaji/Egbema", "Okigwe", "Onuimo", "Orlu", "Orsu", "Oru East", "Oru West", "Owerri Municipal", "Owerri North", "Owerri West"],
  "Jigawa": ["Auyo", "Babura", "Biriniwa", "Birnin Kudu", "Buji", "Dutse", "Gagarawa", "Garki", "Gumel", "Guri", "Gwaram", "Gwiwa", "Hadejia", "Jahun", "Kafin Hausa", "Kaugama", "Kazaure", "Kiri Kasama", "Kiyawa", "Maigatari", "Malam Madori", "Miga", "Ringim", "Roni", "Sule Tankarkar", "Taura", "Yankwashi"],
  "Kaduna": ["Birnin Gwari", "Chikun", "Giwa", "Igabi", "Ikara", "Jaba", "Jema'a", "Kachia", "Kaduna North", "Kaduna South", "Kagarko", "Kajuru", "Kaura", "Kauru", "Kubau", "Kudan", "Lere", "Makarfi", "Sabon Gari", "Sanga", "Soba", "Zangon Kataf", "Zaria"],
  "Kano": ["Ajingi", "Albasu", "Bagwai", "Bebeji", "Bichi", "Bunkure", "Dala", "Dambatta", "Dawakin Kudu", "Dawakin Tofa", "Doguwa", "Fagge", "Gabasawa", "Garko", "Garun Mallam", "Gaya", "Gezawa", "Gwale", "Gwarzo", "Kabo", "Kano Municipal", "Karaye", "Kibiya", "Kiru", "Kumbotso", "Kunchi", "Kura", "Madobi", "Makoda", "Minjibir", "Nasarawa", "Rano", "Rimin Gado", "Rogo", "Shanono", "Sumaila", "Takai", "Tarauni", "Tofa", "Tsanyawa", "Tudun Wada", "Ungogo", "Warawa", "Wudil"],
  "Katsina": [
    "Bakori", "Batagarawa", "Batsari", "Baure", "Bindawa", "Charanchi", "Dandume",
    "Danja", "Dan Musa", "Daura", "Dutsin-Ma", "Faskari", "Funtua", "Ingawa",
    "Jibia", "Kafur", "Kaita", "Kankara", "Kankia", "Katsina", "Kurfi", "Kusada",
    "Mai'Adua", "Malumfashi", "Mani", "Mashi", "Matazu", "Musawa", "Rimi", "Sabuwa",
    "Safana", "Sandamu", "Zango"
],
"Kebbi": ["Aleiro", "Arewa Dandi", "Argungu", "Augie", "Bagudo", "Birnin Kebbi", "Bunza", "Dandi", "Fakai", "Gwandu", "Jega", "Kalgo", "Koko/Besse", "Maiyama", "Ngaski", "Sakaba", "Shanga", "Suru", "Wasagu/Danko", "Yauri", "Zuru"],
  "Kogi": ["Adavi", "Ajaokuta", "Ankpa", "Bassa", "Dekina", "Ibaji", "Idah", "Igalamela-Odolu", "Ijumu", "Kabba/Bunu", "Kogi", "Lokoja", "Mopa-Muro", "Ofu", "Ogori/Magongo", "Okehi", "Okene", "Olamaboro", "Omala", "Yagba East", "Yagba West"],
  "Kwara": ["Asa", "Baruten", "Edu", "Ekiti", "Ifelodun", "Ilorin East", "Ilorin South", "Ilorin West", "Irepodun", "Isin", "Kaiama", "Moro", "Offa", "Oke Ero", "Oyun", "Pategi"],
   "Nasarawa": ["Akwanga", "Awe", "Doma", "Karu", "Keana", "Keffi", "Kokona", "Lafia", "Nasarawa", "Nasarawa Egon", "Obi", "Toto", "Wamba"],
    "Niger": ["Agaie", "Agwara", "Bida", "Borgu", "Bosso", "Chanchaga", "Edati", "Gbako", "Gurara", "Katcha", "Kontagora", "Lapai", "Lavun", "Magama", "Mariga", "Mashegu", "Mokwa", "Munya", "Paikoro", "Rafi", "Rijau", "Shiroro", "Suleja", "Tafa", "Wushishi"],
    "Ogun": ["Abeokuta North", "Abeokuta South", "Ado-Odo/Ota", "Egbado North", "Egbado South", "Ewekoro", "Ifo", "Ijebu East", "Ijebu North", "Ijebu North East", "Ijebu Ode", "Ikenne", "Imeko Afon", "Ipokia", "Obafemi Owode", "Odeda", "Odogbolu", "Ogun Waterside", "Remo North", "Shagamu"],
    "Ondo": ["Akoko North-East", "Akoko North-West", "Akoko South-East", "Akoko South-West", "Akure North", "Akure South", "Ese Odo", "Idanre", "Ifedore", "Ilaje", "Ile Oluji/Okeigbo", "Irele", "Odigbo", "Okitipupa", "Ondo East", "Ondo West", "Ose", "Owo"],
    "Osun": ["Atakunmosa East", "Atakunmosa West", "Aiyedaade", "Aiyedire", "Boluwaduro", "Boripe", "Ede North", "Ede South", "Egbedore", "Ejigbo", "Ife Central", "Ife East", "Ife North", "Ife South", "Ifedayo", "Ifelodun", "Ila", "Ilesa East", "Ilesa West", "Irepodun", "Irewole", "Isokan", "Iwo", "Obokun", "Odo Otin", "Ola Oluwa", "Olorunda", "Oriade", "Orolu", "Osogbo"],
    "Oyo": ["Afijio", "Akinyele", "Atiba", "Atisbo", "Egbeda", "Ibadan North", "Ibadan North-East", "Ibadan North-West", "Ibadan South-East", "Ibadan South-West", "Ibarapa Central", "Ibarapa East", "Ibarapa North", "Ido", "Irepo", "Iseyin", "Itesiwaju", "Iwajowa", "Kajola", "Lagelu", "Ogbomosho North", "Ogbomosho South", "Ogo Oluwa", "Olorunsogo", "Oluyole", "Ona Ara", "Orelope", "Ori Ire", "Oyo East", "Oyo West", "Saki East", "Saki West", "Surulere"],
    "Plateau": ["Barkin Ladi", "Bassa", "Bokkos", "Jos East", "Jos North", "Jos South", "Kanam", "Kanke", "Langtang North", "Langtang South", "Mangu", "Mikang", "Pankshin", "Qua'an Pan", "Riyom", "Shendam", "Wase"],
    "Rivers": ["Abua/Odual", "Ahoada East", "Ahoada West", "Akuku-Toru", "Andoni", "Asari-Toru", "Bonny", "Degema", "Eleme", "Emohua", "Etche", "Gokana", "Ikwerre", "Khana", "Obio/Akpor", "Ogba/Egbema/Ndoni", "Ogu/Bolo", "Okrika", "Omuma", "Opobo/Nkoro", "Oyigbo", "Port Harcourt", "Tai"],
    "Sokoto": ["Binji", "Bodinga", "Dange Shuni", "Gada", "Goronyo", "Gudu", "Gwadabawa", "Illela", "Isa", "Kebbe", "Kware", "Rabah", "Sabon Birni", "Shagari", "Silame", "Sokoto North", "Sokoto South", "Tambuwal", "Tangaza", "Tureta", "Wamako", "Wurno", "Yabo"],
    "Taraba": ["Ardo Kola", "Bali", "Donga", "Gashaka", "Gassol", "Ibi", "Jalingo", "Karim Lamido", "Kurmi", "Lau", "Sardauna", "Takum", "Ussa", "Wukari", "Yorro", "Zing"],
    "Yobe": ["Bade", "Bursari", "Damaturu", "Fika", "Fune", "Geidam", "Gujba", "Gulani", "Jakusko", "Karasuwa", "Machina", "Nangere", "Nguru", "Potiskum", "Tarmuwa", "Yunusari", "Yusufari"],
    "Zamfara": ["Anka", "Bakura", "Birnin Magaji/Kiyaw", "Bukkuyum", "Bungudu", "Gummi", "Gusau", "Kaura Namoda", "Maradun", "Maru", "Shinkafi", "Talata Mafara", "Chafe", "Zurmi"]};
    
        const stateSelect = document.getElementById("state");
        const lgaSelect = document.getElementById("lga");
    
        // Populate states
        for (let state in statesAndLGAs) {
            const option = document.createElement("option");
            option.value = state;
            option.textContent = state;
            stateSelect.appendChild(option);
        }
    
        // Handle LGA population
        stateSelect.addEventListener("change", function () {
            const selectedState = this.value;
    
            // Clear existing LGAs
            lgaSelect.innerHTML = '<option value="">-- Select LGA --</option>';
    
            if (selectedState in statesAndLGAs) {
                statesAndLGAs[selectedState].forEach(lga => {
                    const option = document.createElement("option");
                    option.value = lga;
                    option.textContent = lga;
                    lgaSelect.appendChild(option);
                });
            }
        });
    });
    </script>
    
