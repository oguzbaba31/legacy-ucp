<?php
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'roleplay'); 

error_reporting(0);

$server_ip = "127.0.0.1:7777";

$server_ip_only = "127.0.0.1";

$weblink = "http";
  
// Here append the common URL characters. 
$weblink .= "://"; 
  
// Append the host(domain name, ip) to the URL. 
$weblink .= $_SERVER['HTTP_HOST']; 
  
// Append the requested resource location to the URL 
$weblink .= $_SERVER['REQUEST_URI'];

$url = $_SERVER['HTTP_HOST']; 

$admin_panel = false;
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

$cars = array
(
    "Landstalker", "Bravura", "Buffalo", "Linerunner", "Perrenial", "Sentinel", "Dumper", "Firetruck", "Trashmaster",
    "Stretch", "Manana", "Infernus", "Voodoo", "Pony", "Mule", "Cheetah", "Ambulance", "Leviathan", "Moonbeam",
    "Esperanto", "Taxi", "Washington", "Bobcat", "Whoopee", "BF Injection", "Hunter", "Premier", "Enforcer",
    "Securicar", "Banshee", "Predator", "Bus", "Rhino", "Barracks", "Hotknife", "Trailer", "Previon", "Coach",
    "Cabbie", "Stallion", "Rumpo", "RC Bandit", "Romero", "Packer", "Monster", "Admiral", "Squalo", "Seasparrow",
    "Pizzaboy", "Tram", "Trailer", "Turismo", "Speeder", "Reefer", "Tropic", "Flatbed", "Yankee", "Caddy", "Solair",
    "Berkley's RC Van", "Skimmer", "PCJ-600", "Faggio", "Freeway", "RC Baron", "RC Raider", "Glendale", "Oceanic",
    "Sanchez", "Sparrow", "Patriot", "Quad", "Coastguard", "Dinghy", "Hermes", "Sabre", "Rustler", "ZR-350", "Walton",
    "Regina", "Comet", "BMX", "Burrito", "Camper", "Marquis", "Baggage", "Dozer", "Maverick", "News Chopper", "Rancher",
    "FBI Rancher", "Virgo", "Greenwood", "Jetmax", "Hotring", "Sandking", "Blista Compact", "Police Maverick",
    "Boxville", "Benson", "Mesa", "RC Goblin", "Hotring Racer A", "Hotring Racer B", "Bloodring Banger", "Rancher",
    "Super GT", "Elegant", "Journey", "Bike", "Mountain Bike", "Beagle", "Cropduster", "Stunt", "Tanker", "Roadtrain",
    "Nebula", "Majestic", "Buccaneer", "Shamal", "Hydra", "FCR-900", "NRG-500", "HPV1000", "Cement Truck", "TowTruck",
    "Fortune", "Cadrona", "SWAT Truck", "Willard", "Forklift", "Tractor", "Combine", "Feltzer", "Remington", "Slamvan",
    "Blade", "Streak", "Freight", "Vortex", "Vincent", "Bullet", "Clover", "Sadler", "Firetruck", "Hustler", "Intruder",
    "Primo", "Cargobob", "Tampa", "Sunrise", "Merit", "Utility", "Nevada", "Yosemite", "Windsor", "Monster", "Monster",
    "Uranus", "Jester", "Sultan", "Stratum", "Elegy", "Raindance", "RC Tiger", "Flash", "Tahoma", "Savanna", "Bandito",
    "Freight Flat", "Streak Carriage", "Kart", "Mower", "Dune", "Sweeper", "Broadway", "Tornado", "AT-400", "DFT-30",
    "Huntley", "Stafford", "BF-400", "News Van", "Tug", "Trailer", "Emperor", "Wayfarer", "Euros", "Hotdog", "Club",
    "Freight Box", "Trailer", "Andromada", "Dodo", "RC Cam", "Launch", "LSPD Cruiser", "SFPD Cruiser", "LVPD Cruiser",
    "Police Rancher", "Picador", "S.W.A.T", "Alpha", "Phoenix", "Glendale", "Sadler", "Luggage", "Luggage", "Stairs",
    "Boxville", "Tiller", "Utility Trailer"
);

$serverSkins = array
(
	array("id"=>1, "name"=>"truth", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>2, "name"=>"maccer", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>3, "name"=>"andre", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>4, "name"=>"bbthin", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>5, "name"=>"bb", "race"=>2, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>6, "name"=>"emmet", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>7, "name"=>"male01", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>8, "name"=>"janitor", "race"=>3, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>9, "name"=>"bfori", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>10, "name"=>"bfost", "race"=>2, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>11, "name"=>"vbfycrp", "race"=>2, "gender"=>2, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>12, "name"=>"bfyri", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>13, "name"=>"bfyst", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>14, "name"=>"bmori", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>15, "name"=>"bmost", "race"=>2, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>16, "name"=>"bmyap", "race"=>2, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>17, "name"=>"bmybu", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>18, "name"=>"bmybe", "race"=>2, "gender"=>1, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>19, "name"=>"bmydj", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>20, "name"=>"bmyri", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>21, "name"=>"bmycr", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>22, "name"=>"bmyst", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>23, "name"=>"wmybmx", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>24, "name"=>"wbydg1", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>25, "name"=>"wbydg2", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>26, "name"=>"wmybp", "race"=>1, "gender"=>1, "weight"=>1, "category"=>5, "factions"=>[]),
	array("id"=>27, "name"=>"wmycon", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>28, "name"=>"bmydrug", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>29, "name"=>"wmydrug", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>30, "name"=>"hmydrug", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>31, "name"=>"dwfolc", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>32, "name"=>"dwmolc1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>33, "name"=>"dwmolc2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>34, "name"=>"dwmylc1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>35, "name"=>"hmogar", "race"=>3, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>36, "name"=>"wmygol1", "race"=>2, "gender"=>1, "weight"=>1, "category"=>5, "factions"=>[]),
	array("id"=>37, "name"=>"wmygol2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>5, "factions"=>[]),
	array("id"=>39, "name"=>"hfost", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>40, "name"=>"hfyri", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>41, "name"=>"hfyst", "race"=>3, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>42, "name"=>"jethro", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>43, "name"=>"hmori", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>44, "name"=>"hmost", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>45, "name"=>"hmybe", "race"=>1, "gender"=>1, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>46, "name"=>"hmyri", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>47, "name"=>"hmycr", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>48, "name"=>"hmyst", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>49, "name"=>"omokung", "race"=>4, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>50, "name"=>"wmymech", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>51, "name"=>"bmymoun", "race"=>2, "gender"=>1, "weight"=>1, "category"=>5, "factions"=>[]),
	array("id"=>52, "name"=>"wmymoun", "race"=>1, "gender"=>1, "weight"=>1, "category"=>5, "factions"=>[]),
	array("id"=>54, "name"=>"ofost", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>55, "name"=>"ofyri", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>56, "name"=>"ofyst", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>57, "name"=>"omori", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>58, "name"=>"omost", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>59, "name"=>"omyri", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>60, "name"=>"omyst", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>61, "name"=>"wmyplt", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>62, "name"=>"wmopj", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>63, "name"=>"bfypro", "race"=>3, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>64, "name"=>"hfypro", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>65, "name"=>"kendl", "race"=>2, "gender"=>2, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>66, "name"=>"bmypol1", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>67, "name"=>"bmypol2", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>68, "name"=>"wmoprea", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>69, "name"=>"sbfyst", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>72, "name"=>"swmyhp1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>73, "name"=>"swmyhp2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>75, "name"=>"swfopro", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>76, "name"=>"wfystew", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>77, "name"=>"swmotr1", "race"=>1, "gender"=>2, "weight"=>2, "category"=>8, "factions"=>[]),
	array("id"=>78, "name"=>"wmotr1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>79, "name"=>"bmotr1", "race"=>2, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>80, "name"=>"vbmybox", "race"=>2, "gender"=>1, "weight"=>3, "category"=>5, "factions"=>[]),
	array("id"=>81, "name"=>"wmybox", "race"=>1, "gender"=>1, "weight"=>3, "category"=>5, "factions"=>[]),
	array("id"=>82, "name"=>"vhmyelv", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>83, "name"=>"vbmyelv", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>84, "name"=>"vimyelv", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>85, "name"=>"vwfypro", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>86, "name"=>"ryder3", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>87, "name"=>"vwfyst1", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>88, "name"=>"wfori", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>89, "name"=>"wfost", "race"=>1, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>90, "name"=>"wfyjg", "race"=>1, "gender"=>2, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>91, "name"=>"wfyri", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>93, "name"=>"wfyst", "race"=>1, "gender"=>2, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>94, "name"=>"wmori", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>95, "name"=>"wmost", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>96, "name"=>"wmyjg", "race"=>1, "gender"=>1, "weight"=>1, "category"=>5, "factions"=>[]),
	array("id"=>97, "name"=>"wmylg", "race"=>1, "gender"=>1, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>98, "name"=>"wmyri", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>100, "name"=>"wmycr", "race"=>1, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>101, "name"=>"wmyst", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>102, "name"=>"ballas1", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>103, "name"=>"ballas2", "race"=>2, "gender"=>1, "weight"=>2, "category"=>2, "factions"=>[]),
	array("id"=>104, "name"=>"ballas3", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>105, "name"=>"fam1", "race"=>2, "gender"=>1, "weight"=>2, "category"=>2, "factions"=>[]),
	array("id"=>106, "name"=>"fam2", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>107, "name"=>"fam3", "race"=>2, "gender"=>1, "weight"=>3, "category"=>2, "factions"=>[]),
	array("id"=>108, "name"=>"lsv1", "race"=>3, "gender"=>1, "weight"=>3, "category"=>2, "factions"=>[]),
	array("id"=>109, "name"=>"lsv2", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>110, "name"=>"lsv3", "race"=>3, "gender"=>1, "weight"=>3, "category"=>2, "factions"=>[]),
	array("id"=>111, "name"=>"maffa", "race"=>1, "gender"=>1, "weight"=>3, "category"=>1, "factions"=>[]),
	array("id"=>112, "name"=>"maffb", "race"=>1, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>113, "name"=>"mafboss", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>114, "name"=>"vla1", "race"=>3, "gender"=>1, "weight"=>3, "category"=>2, "factions"=>[]),
	array("id"=>115, "name"=>"vla2", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>116, "name"=>"vla3", "race"=>3, "gender"=>1, "weight"=>3, "category"=>2, "factions"=>[]),
	array("id"=>117, "name"=>"triada", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>118, "name"=>"triadb", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>119, "name"=>"sindaco", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>120, "name"=>"triboss", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>121, "name"=>"dnb1", "race"=>4, "gender"=>1, "weight"=>2, "category"=>2, "factions"=>[]),
	array("id"=>122, "name"=>"dnb2", "race"=>4, "gender"=>1, "weight"=>3, "category"=>2, "factions"=>[]),
	array("id"=>123, "name"=>"dnb3", "race"=>4, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>124, "name"=>"vmaff1", "race"=>1, "gender"=>1, "weight"=>3, "category"=>1, "factions"=>[]),
	array("id"=>125, "name"=>"vmaff2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>126, "name"=>"vmaff3", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>127, "name"=>"vmaff4", "race"=>1, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>128, "name"=>"dnmylc", "race"=>3, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>129, "name"=>"dnfolc1", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>130, "name"=>"dnfolc2", "race"=>1, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>131, "name"=>"dnfylc", "race"=>3, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>132, "name"=>"dnmolc1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>133, "name"=>"dnmolc2", "race"=>1, "gender"=>1, "weight"=>3, "category"=>3, "factions"=>[]),
	array("id"=>134, "name"=>"sbmotr2", "race"=>2, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>135, "name"=>"swmotr2", "race"=>1, "gender"=>1, "weight"=>2, "category"=>8, "factions"=>[]),
	array("id"=>136, "name"=>"sbmytr3", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>137, "name"=>"swmotr3", "race"=>1, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>138, "name"=>"wfybe", "race"=>1, "gender"=>2, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>139, "name"=>"bfybe", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>140, "name"=>"hfybe", "race"=>3, "gender"=>2, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>141, "name"=>"sofybu", "race"=>4, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>142, "name"=>"sbmyst", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>143, "name"=>"sbmycr", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>144, "name"=>"bmycg", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>145, "name"=>"wfycrk", "race"=>1, "gender"=>2, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>146, "name"=>"hmycm", "race"=>1, "gender"=>1, "weight"=>3, "category"=>7, "factions"=>[]),
	array("id"=>147, "name"=>"wmybu", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>148, "name"=>"bfybu", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>150, "name"=>"wfybu", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>151, "name"=>"dwfylc1", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>152, "name"=>"wfypro", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>153, "name"=>"wmyconb", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>154, "name"=>"wmybe", "race"=>1, "gender"=>1, "weight"=>3, "category"=>7, "factions"=>[]),
	array("id"=>155, "name"=>"wmypizz", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>156, "name"=>"bmobar", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>157, "name"=>"cwfyhb", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>158, "name"=>"cwmofr", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>159, "name"=>"cwmohb1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>160, "name"=>"cwmohb2", "race"=>1, "gender"=>1, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>161, "name"=>"cwmyfr", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>162, "name"=>"cwmyhb1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>163, "name"=>"bmyboun", "race"=>2, "gender"=>1, "weight"=>3, "category"=>6, "factions"=>[]),
	array("id"=>164, "name"=>"wmyboun", "race"=>1, "gender"=>1, "weight"=>3, "category"=>6, "factions"=>[]),
	array("id"=>165, "name"=>"wmomib", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>166, "name"=>"bmymib", "race"=>2, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>167, "name"=>"wmybell", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>168, "name"=>"bmochil", "race"=>2, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>169, "name"=>"sofyri", "race"=>4, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>170, "name"=>"somyst", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>171, "name"=>"vwmybjd", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>172, "name"=>"vwfycrp", "race"=>1, "gender"=>2, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>173, "name"=>"sfr1", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>174, "name"=>"sfr2", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>175, "name"=>"sfr3", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>176, "name"=>"bmybar", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>177, "name"=>"wmybar", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>178, "name"=>"wfysex", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>179, "name"=>"wmyammo", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>180, "name"=>"bmytatt", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>181, "name"=>"vwmycr", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>182, "name"=>"vbmocd", "race"=>2, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>183, "name"=>"vbmycr", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>184, "name"=>"vhmycr", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>185, "name"=>"sbmyri", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>186, "name"=>"somyri", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>187, "name"=>"somybu", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>188, "name"=>"swmyst", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>189, "name"=>"wmyva", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>190, "name"=>"copgrl3", "race"=>2, "gender"=>2, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>191, "name"=>"gungrl3", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>192, "name"=>"mecgrl3", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>193, "name"=>"nurgrl3", "race"=>4, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>194, "name"=>"crogrl3", "race"=>1, "gender"=>2, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>195, "name"=>"gangrl3", "race"=>2, "gender"=>2, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>196, "name"=>"cwfofr", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>197, "name"=>"cwfohb", "race"=>1, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>198, "name"=>"cwfyfr1", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>199, "name"=>"cwfyfr2", "race"=>1, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>200, "name"=>"cwmyhb2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>201, "name"=>"dwfylc2", "race"=>1, "gender"=>2, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>202, "name"=>"dwmylc2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>203, "name"=>"omykara", "race"=>4, "gender"=>1, "weight"=>3, "category"=>6, "factions"=>[]),
	array("id"=>204, "name"=>"wmykara", "race"=>1, "gender"=>1, "weight"=>3, "category"=>6, "factions"=>[]),
	array("id"=>205, "name"=>"wfyburg", "race"=>1, "gender"=>2, "weight"=>2, "category"=>6, "factions"=>[]),
	array("id"=>206, "name"=>"vwmycd", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>207, "name"=>"vhfypro", "race"=>3, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>208, "name"=>"suzie", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>209, "name"=>"omonood", "race"=>4, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>210, "name"=>"omoboat", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>211, "name"=>"wfyclot", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>212, "name"=>"vwomotr1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>213, "name"=>"vwomotr2", "race"=>1, "gender"=>1, "weight"=>2, "category"=>8, "factions"=>[]),
	array("id"=>214, "name"=>"vwfywai", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>215, "name"=>"sbfori", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>216, "name"=>"swfyri", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>217, "name"=>"wmyclot", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>218, "name"=>"sbfost", "race"=>2, "gender"=>2, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>219, "name"=>"sbfyri", "race"=>2, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>220, "name"=>"sbmocd", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>221, "name"=>"sbmori", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>222, "name"=>"sbmost", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>223, "name"=>"shmycr", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>224, "name"=>"sofori", "race"=>4, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>225, "name"=>"sofost", "race"=>4, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>226, "name"=>"sofyst", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>227, "name"=>"somobu", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>228, "name"=>"somori", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>229, "name"=>"somost", "race"=>4, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>230, "name"=>"swmotr5", "race"=>1, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>231, "name"=>"swfori", "race"=>1, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>232, "name"=>"swfost", "race"=>1, "gender"=>2, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>233, "name"=>"swfyst", "race"=>1, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>234, "name"=>"swmocd", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>235, "name"=>"swmori", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>236, "name"=>"swmost", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>237, "name"=>"shfypro", "race"=>3, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>238, "name"=>"sbfypro", "race"=>2, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>239, "name"=>"swmotr4", "race"=>1, "gender"=>1, "weight"=>1, "category"=>8, "factions"=>[]),
	array("id"=>240, "name"=>"swmyri", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>241, "name"=>"smyst", "race"=>3, "gender"=>1, "weight"=>2, "category"=>3, "factions"=>[]),
	array("id"=>242, "name"=>"smyst2", "race"=>3, "gender"=>1, "weight"=>2, "category"=>2, "factions"=>[]),
	array("id"=>243, "name"=>"sfypro", "race"=>3, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>244, "name"=>"vbfyst2", "race"=>2, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>245, "name"=>"vbfypro", "race"=>2, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>246, "name"=>"vhfyst3", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>247, "name"=>"bikera", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>248, "name"=>"bikerb", "race"=>1, "gender"=>1, "weight"=>1, "category"=>3, "factions"=>[]),
	array("id"=>249, "name"=>"bmypimp", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>250, "name"=>"swmycr", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>251, "name"=>"wfylg", "race"=>1, "gender"=>2, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>252, "name"=>"wmyva2", "race"=>1, "gender"=>1, "weight"=>1, "category"=>7, "factions"=>[]),
	array("id"=>253, "name"=>"bmosec", "race"=>2, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>254, "name"=>"bikdrug", "race"=>1, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>255, "name"=>"wmych", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>256, "name"=>"sbfystr", "race"=>2, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>257, "name"=>"swfystr", "race"=>1, "gender"=>2, "weight"=>1, "category"=>4, "factions"=>[]),
	array("id"=>258, "name"=>"heck1", "race"=>1, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>259, "name"=>"heck2", "race"=>1, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>260, "name"=>"bmycon", "race"=>2, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>261, "name"=>"wmycd1", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>262, "name"=>"bmocd", "race"=>2, "gender"=>1, "weight"=>2, "category"=>1, "factions"=>[]),
	array("id"=>263, "name"=>"vwfywa2", "race"=>4, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>264, "name"=>"wmoice", "race"=>1, "gender"=>1, "weight"=>2, "category"=>6, "factions"=>[]),
	array("id"=>268, "name"=>"dwayne", "race"=>1, "gender"=>1, "weight"=>1, "category"=>6, "factions"=>[]),
	array("id"=>269, "name"=>"smoke", "race"=>2, "gender"=>1, "weight"=>2, "category"=>2, "factions"=>[]),
	array("id"=>270, "name"=>"sweet", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>271, "name"=>"ryder", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>272, "name"=>"forelli", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>273, "name"=>"tbone", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>289, "name"=>"zero", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>290, "name"=>"rose", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>291, "name"=>"paul", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>292, "name"=>"cesar", "race"=>3, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>293, "name"=>"ogloc", "race"=>2, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>294, "name"=>"wuzimu", "race"=>4, "gender"=>1, "weight"=>1, "category"=>2, "factions"=>[]),
	array("id"=>295, "name"=>"torino", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>296, "name"=>"jizzy", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>297, "name"=>"maddogg", "race"=>2, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>298, "name"=>"cat", "race"=>3, "gender"=>2, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>299, "name"=>"claude", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[])
	/*array("id"=>303, "name"=>"lapdpc", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>304, "name"=>"lapdpd", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[]),
	array("id"=>305, "name"=>"lvpdpc", "race"=>1, "gender"=>1, "weight"=>1, "category"=>1, "factions"=>[])*/
);
 
$vehicleColors = array
(
	"Black", "White", "Light Blue", "Red", "Dark Green", "Pink", "Yellow", "Light Blue", "Silver", "Grey", "Grey", "Dark Grey", "Silver",
	"Dark Grey", "Light Brown", "Light Brown", "Green", "Red", "Light Red", "Brown", "Light Blue", "Light Red", "Light Red", "Brown",
	"Grey", "Dark Grey", "Light Brown", "Dark Brown", "Light Blue", "Light Brown", "Maroon", "Light Red", "Silver", "Light Brown", "Brown",
	"Brown", "Dark Brown", "Dark Green", "Light Green", "Grey", "Dark Brown", "Brown", "Light Red", "Dark Red", "Green", "Red",
	"Sandy Brown", "Light Brown", "Light Brown", "Pale Brown", "Brown", "Green", "Dark Green", "Dark Blue", "Purple",
	"Brown", "Silver", "Light Brown", "Red", "Light Blue", "Grey", "Tan", "Maroon", "Silver", "Silver", "Olive Green", "Maroon", "Light Blue",
	"Grey", "Grey", "Red", "Light Blue", "Dark Grey", "Light Green", "Dark Green", "Dark Blue", "Grey", "Grey", "Red", "Blue", "Maroon", "Olive", "Red",
	"Dark Green", "Brown", "Magenta", "Bright Green", "Sky Blue", "Maroon", "Grey", "Silver", "Dark Blue", "Grey", "Bright Blue", "Light Blue",
	"Dark Blue", "Grey", "Light Blue", "Light Blue", "Tan", "Light Blue", "Dark Blue", "Tan", "Blue", "Brown", "Grey", "Blue", "Brown",
	"Blue", "Dark Grey", "Light Grey", "Brown", "Light Blue", "Brown", "Green", "Bright Red", "Blue", "Red", "Silver", "Brown", "Tan", "Maroon",
	"Grey", "Bright Brown", "Red", "Bright Blue", "Pink", "Black", "Green", "Burgandy", "Cyan", "Gold", "Light Red", "Dark Green", "Blue", "Light Blue",
	"Violet", "Lime Green", "White", "Blue", "Silver", "Light Brown", "Light Yellow", "Light Purple", "Purple", "Light Green", "Pink", "Purple", "Brown", "Brown", 
	"Dark Green", "Dark Green", "Blue", "Green", "Green", "Cyan", "Cream", "Blue", "Orange", "Brown", "Green", "Light Pink", "Blue", "Light Blue", "Dark Green", "Light Blue",
	"Blue", "Purple", "Brown", "Light Purple", "Light Purple", "Purple", "Olive Green", "Brown", "Brown", "Light Orange", "Purple", "Light Purple", "Pink", "Purple", "Brown",
	"Orange", "Brown", "Orange", "Pink", "Silver", "Dark Green", "Dark Green", "Dark Green", "Dark Green", "Pink", "Light Green", "Silver",
	"Silver", "Yellow", "Light Yellow", "Silver", "Yellow", "Dark Blue", "Olive Green", "Light Brown", "Dark Blue", "Dark Green", "Dark Blue", "Blue", "Dark Blue", "Dark Blue",
	"Blue", "Blue", "Blue", "Dark Blue", "Purple", "Orange", "Silver", "Olive Green", "Dark Green", "Light Brown", "Light Blue", "Light Brown", "Orange", "Pink",
	"Cream", "Orange", "Dark Blue", "Burgandy", "Olive Green","Lime Green","Dark Green","Yellow","Green","Red","Gold", "Purple", "Purple", "Green",
	"Light Green", "Light Blue", "Light Pink", "Light Brown", "Light Orange", "Cyan", "Lime Green", "Dark Pink", "Light Green", "Brown", "Dark Green",
	"Blue", "Light Blue", "Burgandy", "Burgandy", "Grey", "Grey", "Grey", "Grey", "Grey", "Blue"
);

function ReturnAreaCode($areaid)
{
	if("Los Santos International" == $zonat[$areaid][0]) return 218;
	if("Ocean Docks" == $zonat[$areaid][0]) return 218;
	if("Santa Maria Beach" == $zonat[$areaid][0]) return 218;
	if("Verona Beach" == $zonat[$areaid][0]) return 313;
	if("Marina" == $zonat[$areaid][0]) return 313;
	if("Rodeo" == $zonat[$areaid][0]) return 802;
	if("Temple" == $zonat[$areaid][0]) return 343;
	if("Market" == $zonat[$areaid][0]) return 343;
	if("Downtown" == $zonat[$areaid][0]) return 206;
	if("Pershing Square" == $zonat[$areaid][0]) return 206;
	if("Glen Park" == $zonat[$areaid][0]) return 826;
	if("Verdant Bluffs" == $zonat[$areaid][0]) return 216;
	if("Idlewood" == $zonat[$areaid][0]) return 415;
	if("Ganton" == $zonat[$areaid][0]) return 516;
	if("El Corona" == $zonat[$areaid][0]) return 516;
	if("Willowfield" == $zonat[$areaid][0]) return 516;
	if("Playa Del Seville" == $zonat[$areaid][0]) return 516;
	if("East Beach" == $zonat[$areaid][0]) return 616;
	if("Jefferson" == $zonat[$areaid][0]) return 424;
	if("East Los Santos" == $zonat[$areaid][0]) return 424;
	if("Jefferson" == $zonat[$areaid][0]) return 424;
	if("East Los Santos" == $zonat[$areaid][0]) return 424;
	if("Vinewood" == $zonat[$areaid][0]) return 806;
	if("Richman" == $zonat[$areaid][0]) return 806;
	if("Mulholland" == $zonat[$areaid][0]) return 806;
	if("North Rock" == $zonat[$areaid][0]) return 828;
	if("Palomino Creek" == $zonat[$areaid][0]) return 835;
	if("Montgomery" == $zonat[$areaid][0]) return 824;
	if("Dillimore" == $zonat[$areaid][0]) return 808;
	if("Blueberry" == $zonat[$areaid][0]) return 890;
	if("Blueberry Acres" == $zonat[$areaid][0]) return 890;
	if("The Panopticon" == $zonat[$areaid][0]) return 890;
	if("Fallen Tree" == $zonat[$areaid][0]) return 890;
	if("Easter Bay Chemicals" == $zonat[$areaid][0]) return 843;
	if("The Farm" == $zonat[$areaid][0]) return 843;
	if("Flint Country" == $zonat[$areaid][0]) return 856;
	if("Angel Pine" == $zonat[$areaid][0]) return 856;
	if("Fort Carson" == $zonat[$areaid][0]) return 855;
	if("Harmony Oaks" == $zonat[$areaid][0]) return 310;
	return 999;
}

function ReturnAreaCodeByName($areaid)
{
	if("Los Santos International" == $areaid) return 218;
	if("Ocean Docks" == $areaid) return 218;
	if("Santa Maria Beach" == $areaid) return 218;
	if("Verona Beach" == $areaid) return 313;
	if("Marina" == $areaid) return 313;
	if("Rodeo" == $areaid) return 802;
	if("Temple" == $areaid) return 343;
	if("Market" == $areaid) return 343;
	if("Downtown" == $areaid) return 206;
	if("Pershing Square" == $areaid) return 206;
	if("Glen Park" == $areaid) return 826;
	if("Verdant Bluffs" == $areaid) return 216;
	if("Idlewood" == $areaid) return 415;
	if("Ganton" == $areaid) return 516;
	if("El Corona" == $areaid) return 516;
	if("Willowfield" == $areaid) return 516;
	if("Playa Del Seville" == $areaid) return 516;
	if("East Beach" == $areaid) return 616;
	if("Jefferson" == $areaid) return 424;
	if("East Los Santos" == $areaid) return 424;
	if("Jefferson" == $areaid) return 424;
	if("East Los Santos" == $areaid) return 424;
	if("Vinewood" == $areaid) return 806;
	if("Richman" == $areaid) return 806;
	if("Mulholland" == $areaid) return 806;
	if("North Rock" == $areaid) return 828;
	if("Palomino Creek" == $areaid) return 835;
	if("Montgomery" == $areaid) return 824;
	if("Dillimore" == $areaid) return 808;
	if("Blueberry" == $areaid) return 890;
	if("Blueberry Acres" == $areaid) return 890;
	if("The Panopticon" == $areaid) return 890;
	if("Fallen Tree" == $areaid) return 890;
	if("Easter Bay Chemicals" == $areaid) return 843;
	if("The Farm" == $areaid) return 843;
	if("Flint Country" == $areaid) return 856;
	if("Angel Pine" == $areaid) return 856;
	if("Fort Carson" == $areaid) return 855;
	if("Harmony Oaks" == $areaid) return 310;
	return 999;
}

function ReturnCityCode($cityid)
{
	if("Los Santos" == $cities[$cityid][0]) return 213;
	if("San Fierro" == $cities[$cityid][0]) return 415;
    if("Las Venturas" == $cities[$cityid][0]) return 702;
    if("Flint County" == $cities[$cityid][0]) return 707;
    if("Red County" == $cities[$cityid][0]) return 714;
    if("Bone County" == $cities[$cityid][0]) return 760;
    if("Tierra Robada" == $cities[$cityid][0]) return 619;
    if("Whetstone" == $cities[$cityid][0]) return 408;
	return 555;
}

$cities = array
(
    array("Los Santos",                  44.60,-2892.90,-242.90,2997.00,-768.00,900.00),
    array("Las Venturas",                869.40,596.30,-242.90,2997.00,2993.80,900.00),
    array("Bone County",                 -480.50,596.30,-242.90,869.40,2993.80,900.00),
    array("Tierra Robada",               -2997.40,1659.60,-242.90,-480.50,2993.80,900.00),
    array("Tierra Robada",               -1213.90,596.30,-242.90,-480.50,1659.60,900.00),
    array("San Fierro",                  -2997.40,-1115.50,-242.90,-1213.90,1659.60,900.00),
    array("Red County",                  -1213.90,-768.00,-242.90,2997.00,596.30,900.00),
    array("Flint County",                -1213.90,-2892.90,-242.90,44.60,-768.00,900.00),
    array("Whetstone",                   -2997.40,-2892.90,-242.90,-1213.90,-1115.50,900.00)
);

$streets = array
(
	array("Imperial Avenue", 1951.0, -1923.0, 1967.0, -1760.0),
	array("Imperial Avenue", 1951.0, -2159.0, 1967.0, -1935.0),
	array("Newport Boulevard", 1814.0, -2174.0, 2065.0, -2159.0),
	array("Kings Avenue", 1812.0, -2161.0, 1952.0, -2043.0),
	array("28th Street", 1649.0, -2161.0, 1812.0, -2043.0),
	array("Newport Boulevard", 1649.0, -2174.0, 1815.0, -2161.0),
	array("Newport Boulevard", 1515.0, -2048.0, 1651.0, -1863.0),
	array("Newport Boulevard", 1515.0, -2173.0, 1651.0, -2048.0),
	array("Unity Boulevard", 1806.0, -1969.0, 1952.0, -1814.0),
	array("Unity Boulevard", 1951.0, -1937.0, 2067.0, -1923.0),
	array("38th Street", 1806.0, -2043.0, 1951.0, -1969.0),
	array("Unity Station", 1651.0, -2043.0, 1807.0, -1814.0),
	array("Martin Luther King Drive", 1930.0, -1743.0, 1955.0, -1620.0),
	array("Artesia Avenue", 1806.0, -1814.0, 1930.0, -1620.0),
	array("Winona Avenue", 1930.0, -1762.0, 2188.0, -1743.0),
	array("Idle Gas", 1930.0, -1815.0, 1951.0, -1760.0),
	array("Arbor Vitae Street", 1807.0, -1619.5, 2075.0, -1527.5),
	array("Dalerose", 1967.0, -1923.0, 2065.0, -1760.0),
	array("Hill Street", 1700.0, -1814.0, 1807.0, -1714.0),
	array("Cypress Ave", 1700.0, -1714.0, 1808.0, -1607.0),
	array("Central Street", 1405.0, -1608.5, 1808.0, -1575.5),
	array("Lucas Avenue", 1676.0, -1813.5, 1702.0, -1608.5),
	array("Grove Street", 2220.0, -1721.5, 2420.0, -1639.5),
	array("Grove Street", 2440.0, -1720.5, 2542.0, -1629.5),
	array("Graham Avenue", 2420.0, -1721.5, 2440.0, -1445.5),
	array("Ganton Boulevard", 2220.0, -1755.5, 2543.0, -1720.5),
	array("Ganton Blues", 2220.0, -1854.5, 2407.0, -1755.5),
	array("54th Street", 2440.0, -1595.5, 2548.0, -1449.5),
	array("54th Street", 2548.0, -1527.5, 2585.0, -1449.5),
	array("Cedar Street", 2420.0, -1449.5, 2635.0, -1429.5),
	array("Alexandria Avenue", 2331.0, -1641.5, 2356.0, -1383.5),
	array("Bronson Street", 2222.0, -1607.5, 2333.0, -1470.5),
	array("Palmwood Avenue", 2124.0, -1607.5, 2224.0, -1470.5),
	array("Crenshaw", 2124.0, -1472.5, 2332.0, -1391.5),
	array("Santa Rosalla Street", 2124.0, -1392.5, 2333.0, -1370.5),
	array("Jefferson", 2061.0, -1371.5, 2334.0, -1085.5),
	array("107th Street", 1955.0, -1743.0, 2015.0, -1620.0),
	array("Prairie Avenue", 2015.0, -1743.0, 2075.0, -1620.0),
	array("Grove Street", 2075.0, -1606.5, 2124.0, -1527.5),
	array("Grove Street", 2075.0, -1646.5, 2331.0, -1606.5),
	array("Crystal Gardens", 2109.0, -1742.5, 2187.0, -1646.5),
	array("106th Street", 2075.0, -1742.5, 2109.0, -1646.5),
	array("Gilmore Avenue", 2065.0, -1937.0, 2088.0, -1761.0),
	array("Westmont Avenue", 2087.0, -1937.0, 2188.0, -1762.0),
	array("Westmont Avenue", 2188.0, -1962.5, 2303.0, -1853.5),
	array("Elbert Street", 2188.0, -2040.5, 2407.0, -1962.5),
	array("Fremont", 2303.0, -1963.5, 2407.0, -1853.5),
	array("Cliffton Avenue", 2407.0, -2040.5, 2423.0, -1755.5),
	array("Arbutus Street", 2423.0, -2041.5, 2549.0, -1937.5),
	array("Sampson Street", 2423.0, -1938.5, 2721.0, -1919.5),
	array("Melrose Avenue", 2702.0, -2148.5, 2724.0, -1938.5),
	array("Acacia Street", 2613.0, -2041.5, 2703.0, -1938.5),
	array("Terminal Way", 2305.0, -2059.5, 2702.0, -2040.5),
	array("Idlewood Highway", 2439.0, -1629.5, 2713.0, -1595.5),
	array("East Beach Sewers", 2542.0, -1919.5, 2623.0, -1629.5),
	array("Ganton Boulevard", 2423.0, -1919.5, 2543.0, -1755.5),
	array("Willowfield Sewers South", 2379.0, -2148.5, 2703.0, -2059.5),
	array("Willowfield Sewers South", 2549.0, -2041.5, 2614.0, -1938.5),
	array("Willowfield Avenue", 2188.0, -1854.5, 2223.0, -1646.5),
	array("Elm Street", 2355.0, -1640.5, 2420.0, -1383.5)
);

$zonat = array
(
	array("Aldea Malvada",               -1372.10,2498.50,0.00,-1277.50,2615.30,200.00),
	array("Angel Pine",                  -2324.90,-2584.20,-6.10,-1964.20,-2212.10,200.00),
	array("Arco del Oeste",              -901.10,2221.80,0.00,-592.00,2571.90,200.00),
	array("Avispa Country Club",         -2361.50,-417.10,0.00,-2270.00,-355.40,200.00),
	array("Avispa Country Club",         -2470.00,-355.40,0.00,-2270.00,-318.40,46.10),
	array("Avispa Country Club",         -2550.00,-355.40,0.00,-2470.00,-318.40,39.70),
	array("Avispa Country Club",         -2646.40,-355.40,0.00,-2270.00,-222.50,200.00),
	array("Avispa Country Club",         -2667.80,-302.10,-28.80,-2646.40,-262.30,71.10),
	array("Avispa Country Club",         -2831.80,-430.20,-6.10,-2646.40,-222.50,200.00),
	array("Back o Beyond",               -1166.90,-2641.10,0.00,-321.70,-1856.00,200.00),
	array("Battery Point",               -2741.00,1268.40,-4.50,-2533.00,1490.40,200.00),
	array("Bayside Marina",              -2353.10,2275.70,0.00,-2153.10,2475.70,200.00),
	array("Bayside",                     -2741.00,2175.10,0.00,-2353.10,2722.70,200.00),
	array("Beacon Hill",                 -399.60,-1075.50,-1.40,-319.00,-977.50,198.50),
	array("Blackfield Chapel",           1325.60,596.30,-89.00,1375.60,795.00,110.90),
	array("Blackfield Chapel",           1375.60,596.30,-89.00,1558.00,823.20,110.90),
	array("Blackfield Section",          1166.50,795.00,-89.00,1375.60,1044.60,110.90),
	array("Blackfield Section",          1197.30,1044.60,-89.00,1277.00,1163.30,110.90),
	array("Blackfield Section",          1277.00,1044.60,-89.00,1315.30,1087.60,110.90),
	array("Blackfield Section",          1375.60,823.20,-89.00,1457.30,919.40,110.90),
	array("Blackfield",                  964.30,1203.20,-89.00,1197.30,1403.20,110.90),
	array("Blackfield",                  964.30,1403.20,-89.00,1197.30,1726.20,110.90),
	array("Blueberry Acres",             -319.60,-220.10,0.00,104.50,293.30,200.00),
	array("Blueberry",                   104.50,-220.10,2.30,349.60,152.20,200.00),
	array("Blueberry",                   19.60,-404.10,3.80,349.60,-220.10,200.00),
	array("Caligula's Palace",           2087.30,1543.20,-89.00,2437.30,1703.20,110.90),
	array("Caligula's Palace",           2137.40,1703.20,-89.00,2437.30,1783.20,110.90),
	array("Calton Heights",              -2274.10,744.10,-6.10,-1982.30,1358.90,200.00),
	array("Castillo del Diablo",			-208.50,2123.00,-7.60,114.00,2337.10,200.00),
	array("Castillo del Diablo",			-208.50,2337.10,0.00,8.40,2487.10,200.00),
	array("Castillo del Diablo",			-464.50,2217.60,0.00,-208.50,2580.30,200.00),
	array("Chinatown",					-2274.10,578.30,-7.60,-2078.60,744.10,200.00),
	array("City Hall",					-2867.80,277.40,-9.10,-2593.40,458.40,200.00),
	array("Come-A-Lot",					2087.30,943.20,-89.00,2623.10,1203.20,110.90),
	array("Commerce",					1323.90,-1722.20,-89.00,1440.90,-1577.50,110.90),
	array("Commerce",					1323.90,-1842.20,-89.00,1701.90,-1722.20,110.90),
	array("Commerce",					1370.80,-1577.50,-89.00,1463.90,-1384.90,110.90),
	array("Commerce",					1463.90,-1577.50,-89.00,1667.90,-1430.80,110.90),
	array("Commerce",					1583.50,-1722.20,-89.00,1758.90,-1577.50,110.90),
	array("Commerce",					1667.90,-1577.50,-89.00,1812.60,-1430.80,110.90),
	array("Conference Center",			1046.10,-1804.20,-89.00,1323.90,-1722.20,110.90),
	array("Conference Center",			1073.20,-1842.20,-89.00,1323.90,-1804.20,110.90),
	array("Cranberry Station",			-2007.80,56.30,0.00,-1922.00,224.70,100.00),
	array("Creek",						2749.90,1937.20,-89.00,2921.60,2669.70,110.90),
	array("Dillimore",					580.70,-674.80,-9.50,861.00,-404.70,200.00),
	array("Doherty",						-2270.00,-324.10,-0.00,-1794.90,-222.50,200.00),
	array("Doherty",                     -2173.00,-222.50,-0.00,-1794.90,265.20,200.00),
	array("Downtown Los Santos",			1370.80,-1170.80,-89.00,1463.90,-1130.80,110.90),
	array("Downtown Los Santos",			1370.80,-1384.90,-89.00,1463.90,-1170.80,110.90),
	array("Downtown Los Santos",			1378.30,-1130.80,-89.00,1463.90,-1026.30,110.90),
	array("Downtown Los Santos",			1391.00,-1026.30,-89.00,1463.90,-926.90,110.90),
	array("Downtown Los Santos",			1463.90,-1290.80,-89.00,1724.70,-1150.80,110.90),
	array("Downtown Los Santos",			1463.90,-1430.80,-89.00,1724.70,-1290.80,110.90),
	array("Downtown Los Santos",			1507.50,-1385.20,110.90,1582.50,-1325.30,335.90),
	array("Downtown Los Santos",			1724.70,-1250.90,-89.00,1812.60,-1150.80,110.90),
	array("Downtown Los Santos",			1724.70,-1430.80,-89.00,1812.60,-1250.90,110.90),
	array("Downtown",					-1580.00,744.20,-6.10,-1499.80,1025.90,200.00),
	array("Downtown",					-1700.00,744.20,-6.10,-1580.00,1176.50,200.00),
	array("Downtown",					-1871.70,1176.40,-4.50,-1620.30,1274.20,200.00),
	array("Downtown",					-1982.30,744.10,-6.10,-1871.70,1274.20,200.00),
	array("Downtown",					-1993.20,265.20,-9.10,-1794.90,578.30,200.00),
	array("Downtown",					-2078.60,578.30,-7.60,-1499.80,744.20,200.00),
	array("East Beach",					2632.80,-1668.10,-89.00,2747.70,-1393.40,110.90),
	array("East Beach",					2632.80,-1852.80,-89.00,2959.30,-1668.10,110.90),
	array("East Beach",					2747.70,-1498.60,-89.00,2959.30,-1120.00,110.90),
	array("East Beach",					2747.70,-1668.10,-89.00,2959.30,-1498.60,110.90),
	array("East Los Santos",				2222.50,-1628.50,-89.00,2421.00,-1494.00,110.90),
	array("East Los Santos",				2266.20,-1494.00,-89.00,2381.60,-1372.00,110.90),
	array("East Los Santos",				2281.40,-1372.00,-89.00,2381.60,-1135.00,110.90),
	array("East Los Santos",				2381.60,-1454.30,-89.00,2462.10,-1135.00,110.90),
	array("East Los Santos",				2381.60,-1494.00,-89.00,2421.00,-1454.30,110.90),
	array("East Los Santos",				2421.00,-1628.50,-89.00,2632.80,-1454.30,110.90),
	array("East Los Santos",				2462.10,-1454.30,-89.00,2581.70,-1135.00,110.90),
	array("Easter Basin",				-1794.90,-50.00,-0.00,-1499.80,249.90,200.00),
	array("Easter Basin",				-1794.90,249.90,-9.10,-1242.90,578.30,200.00),
	array("Easter Bay Airport",			-1213.90,-50.00,-4.50,-947.90,578.30,200.00),
	array("Easter Bay Airport",			-1213.90,-730.10,0.00,-1132.80,-50.00,200.00),
	array("Easter Bay Airport",			-1242.90,-50.00,0.00,-1213.90,578.30,200.00),
	array("Easter Bay Airport",			-1315.40,-405.30,15.40,-1264.40,-209.50,25.40),
	array("Easter Bay Airport",			-1354.30,-287.30,15.40,-1315.40,-209.50,25.40),
	array("Easter Bay Airport",			-1490.30,-209.50,15.40,-1264.40,-148.30,25.40),
	array("Easter Bay Airport",			-1499.80,-50.00,-0.00,-1242.90,249.90,200.00),
	array("Easter Bay Airport",			-1794.90,-730.10,-3.00,-1213.90,-50.00,200.00),
	array("Easter Bay Chemical",			-1132.80,-768.00,0.00,-956.40,-578.10,200.00),
	array("Easter Bay Chemical",			-1132.80,-787.30,0.00,-956.40,-768.00,200.00),
	array("El Corona",					1692.60,-2179.20,-89.00,1812.60,-1842.20,110.90),
	array("El Corona",					1812.60,-2179.20,-89.00,1970.60,-1852.80,110.90),
	array("El Quebrados",				-1645.20,2498.50,0.00,-1372.10,2777.80,200.00),
	array("Esplanade East",				-1499.80,578.30,-79.60,-1339.80,1274.20,20.30),
	array("Esplanade East",				-1580.00,1025.90,-6.10,-1499.80,1274.20,200.00),
	array("Esplanade East",				-1620.30,1176.50,-4.50,-1580.00,1274.20,200.00),
	array("Esplanade North",				-1982.30,1274.20,-4.50,-1524.20,1358.90,200.00),
	array("Esplanade North",				-1996.60,1358.90,-4.50,-1524.20,1592.50,200.00),
	array("Esplanade North",				-2533.00,1358.90,-4.50,-1996.60,1501.20,200.00),
	array("Fallen Tree",					-792.20,-698.50,-5.30,-452.40,-380.00,200.00),
	array("Fallow Bridge",               434.30,366.50,0.00,603.00,555.60,200.00),
	array("Fern Ridge",                  508.10,-139.20,0.00,1306.60,119.50,200.00),
	array("Financial",                   -1871.70,744.10,-6.10,-1701.30,1176.40,300.00),
	array("Fisher's Lagoon",             1916.90,-233.30,-100.00,2131.70,13.80,200.00),
	array("Flint Intersection",          -187.70,-1596.70,-89.00,17.00,-1276.60,110.90),
	array("Flint Range",                 -594.10,-1648.50,0.00,-187.70,-1276.60,200.00),
	array("Fort Carson",                 -376.20,826.30,-3.00,123.70,1220.40,200.00),
	array("Foster Valley",               -2178.60,-1115.50,0.00,-1794.90,-599.80,200.00),
	array("Foster Valley",               -2178.60,-1250.90,0.00,-1794.90,-1115.50,200.00),
	array("Foster Valley",               -2178.60,-599.80,-0.00,-1794.90,-324.10,200.00),
	array("Foster Valley",               -2270.00,-430.20,-0.00,-2178.60,-324.10,200.00),
	array("Four Dragons Casino",         1817.30,863.20,-89.00,2027.30,1083.20,110.90),
	array("Frederick Bridge",            2759.20,296.50,0.00,2774.20,594.70,200.00),
	array("Gant Bridge",                 -2741.00,1490.40,-6.10,-2616.40,1659.60,200.00),
	array("Gant Bridge",                 -2741.40,1659.60,-6.10,-2616.40,2175.10,200.00),
	array("Ganton",                      2222.50,-1722.30,-89.00,2632.80,-1628.50,110.90),
	array("Ganton",                      2222.50,-1852.80,-89.00,2632.80,-1722.30,110.90),
	array("Garcia",                      -2395.10,-222.50,-5.30,-2354.00,-204.70,200.00),
	array("Garcia",                      -2411.20,-222.50,-0.00,-2173.00,265.20,200.00),
	array("Garver Bridge",               -1213.90,950.00,-89.00,-1087.90,1178.90,110.90),
	array("Garver Bridge",               -1339.80,828.10,-89.00,-1213.90,1057.00,110.90),
	array("Garver Bridge",               -1499.80,696.40,-179.60,-1339.80,925.30,20.30),
	array("Glen Park",                   1812.60,-1100.80,-89.00,1994.30,-973.30,110.90),
	array("Glen Park",                   1812.60,-1350.70,-89.00,2056.80,-1100.80,110.90),
	array("Glen Park",                   1812.60,-1449.60,-89.00,1996.90,-1350.70,110.90),
	array("Green Palms",                 176.50,1305.40,-3.00,338.60,1520.70,200.00),
	array("Greenglass College",          964.30,1044.60,-89.00,1197.30,1203.20,110.90),
	array("Greenglass College",          964.30,930.80,-89.00,1166.50,1044.60,110.90),
	array("Hampton Barns",               603.00,264.30,0.00,761.90,366.50,200.00),
	array("Hankypanky Point",            2576.90,62.10,0.00,2759.20,385.50,200.00),
	array("Harry Gold Parkway",          1777.30,863.20,-89.00,1817.30,2342.80,110.90),
	array("Hashbury",                    -2593.40,-222.50,-0.00,-2411.20,54.70,200.00),
	array("Hilltop Farm",                967.30,-450.30,-3.00,1176.70,-217.90,200.00),
	array("Hunter Quarry",               337.20,710.80,-115.20,860.50,1031.70,203.70),
	array("Idlewood",					1812.60,-1602.30,-89.00,2124.60,-1449.60,110.90),
	array("Idlewood",					1812.60,-1742.30,-89.00,1951.60,-1602.30,110.90),
	array("Idlewood",					1812.60,-1852.80,-89.00,1971.60,-1742.30,110.90),
	array("Idlewood",					1951.60,-1742.30,-89.00,2124.60,-1602.30,110.90),
	array("Idlewood",					1971.60,-1852.80,-89.00,2222.50,-1742.30,110.90),
	array("Idlewood",					2124.60,-1742.30,-89.00,2222.50,-1494.00,110.90),
	array("Jefferson",					1996.90,-1449.60,-89.00,2056.80,-1350.70,110.90),
	array("Jefferson",					2056.80,-1210.70,-89.00,2185.30,-1126.30,110.90),
	array("Jefferson",					2056.80,-1372.00,-89.00,2281.40,-1210.70,110.90),
	array("Jefferson",					2056.80,-1449.60,-89.00,2266.20,-1372.00,110.90),
	array("Jefferson",					2124.60,-1494.00,-89.00,2266.20,-1449.60,110.90),
	array("Jefferson",					2185.30,-1210.70,-89.00,2281.40,-1154.50,110.90),
	array("Julius Thruway East",         2536.40,2442.50,-89.00,2685.10,2542.50,110.90),
	array("Julius Thruway East",         2623.10,943.20,-89.00,2749.90,1055.90,110.90),
	array("Julius Thruway East",         2625.10,2202.70,-89.00,2685.10,2442.50,110.90),
	array("Julius Thruway East",         2685.10,1055.90,-89.00,2749.90,2626.50,110.90),
	array("Julius Thruway North",        1377.30,2433.20,-89.00,1534.50,2507.20,110.90),
	array("Julius Thruway North",        1534.50,2433.20,-89.00,1848.40,2583.20,110.90),
	array("Julius Thruway North",        1704.50,2342.80,-89.00,1848.40,2433.20,110.90),
	array("Julius Thruway North",        1848.40,2478.40,-89.00,1938.80,2553.40,110.90),
	array("Julius Thruway North",        1938.80,2508.20,-89.00,2121.40,2624.20,110.90),
	array("Julius Thruway North",        2121.40,2508.20,-89.00,2237.40,2663.10,110.90),
	array("Julius Thruway North",        2237.40,2542.50,-89.00,2498.20,2663.10,110.90),
	array("Julius Thruway North",        2498.20,2542.50,-89.00,2685.10,2626.50,110.90),
	array("Julius Thruway South",        1457.30,823.20,-89.00,2377.30,863.20,110.90),
	array("Julius Thruway South",        2377.30,788.80,-89.00,2537.30,897.90,110.90),
	array("Julius Thruway West",         1197.30,1163.30,-89.00,1236.60,2243.20,110.90),
	array("Julius Thruway West",         1236.60,2142.80,-89.00,1297.40,2243.20,110.90),
	array("Juniper Hill",                -2533.00,578.30,-7.60,-2274.10,968.30,200.00),
	array("Juniper Hollow",              -2533.00,968.30,-6.10,-2274.10,1358.90,200.00),
	array("KACC Military Fuels",         2498.20,2626.50,-89.00,2749.90,2861.50,110.90),
	array("Kincaid Bridge",              -1087.90,855.30,-89.00,-961.90,986.20,110.90),
	array("Kincaid Bridge",              -1213.90,721.10,-89.00,-1087.90,950.00,110.90),
	array("Kincaid Bridge",              -1339.80,599.20,-89.00,-1213.90,828.10,110.90),
	array("King's",                      -2253.50,373.50,-9.10,-1993.20,458.40,200.00),
	array("King's",                      -2329.30,458.40,-7.60,-1993.20,578.30,200.00),
	array("King's",                      -2411.20,265.20,-9.10,-1993.20,373.50,200.00),
	array("LS International",            1249.60,-2394.30,-89.00,1852.00,-2179.20,110.90),
	array("LS International",            1382.70,-2730.80,-89.00,2201.80,-2394.30,110.90),
	array("LS International",            1400.90,-2669.20,-39.00,2189.80,-2597.20,60.90),
	array("LS International",            1852.00,-2394.30,-89.00,2089.00,-2179.20,110.90),
	array("LS International",            1974.60,-2394.30,-39.00,2089.00,-2256.50,60.90),
	array("LS International",            2051.60,-2597.20,-39.00,2152.40,-2394.30,60.90),
	array("LVA Freight Depot",           1236.60,1163.40,-89.00,1277.00,1203.20,110.90),
	array("LVA Freight Depot",           1277.00,1087.60,-89.00,1375.60,1203.20,110.90),
	array("LVA Freight Depot",           1315.30,1044.60,-89.00,1375.60,1087.60,110.90),
	array("LVA Freight Depot",           1375.60,919.40,-89.00,1457.30,1203.20,110.90),
	array("LVA Freight Depot",           1457.30,863.20,-89.00,1777.40,1143.20,110.90),
	array("Las Barrancas",               -926.10,1398.70,-3.00,-719.20,1634.60,200.00),
	array("Las Brujas",                  -365.10,2123.00,-3.00,-208.50,2217.60,200.00),
	array("Las Colinas",                 1994.30,-1100.80,-89.00,2056.80,-920.80,110.90),
	array("Las Colinas",                 2056.80,-1126.30,-89.00,2126.80,-920.80,110.90),
	array("Las Colinas",                 2126.80,-1126.30,-89.00,2185.30,-934.40,110.90),
	array("Las Colinas",                 2185.30,-1154.50,-89.00,2281.40,-934.40,110.90),
	array("Las Colinas",                 2281.40,-1135.00,-89.00,2632.70,-945.00,110.90),
	array("Las Colinas",                 2632.70,-1135.00,-89.00,2747.70,-945.00,110.90),
	array("Las Colinas",                 2747.70,-1120.00,-89.00,2959.30,-945.00,110.90),
	array("Las Payasadas",               -354.30,2580.30,2.00,-133.60,2816.80,200.00),
	array("Las Venturas Airport",        1236.60,1203.20,-89.00,1457.30,1883.10,110.90),
	array("Las Venturas Airport",        1457.30,1143.20,-89.00,1777.40,1203.20,110.90),
	array("Las Venturas Airport",        1457.30,1203.20,-89.00,1777.30,1883.10,110.90),
	array("Las Venturas Airport",        1515.80,1586.40,-12.50,1729.90,1714.50,87.50),
	array("Last Dime Motel",             1823.00,596.30,-89.00,1997.20,823.20,110.90),
	array("Leafy Hollow",                -1166.90,-1856.00,0.00,-815.60,-1602.00,200.00),
	array("Liberty City",                -1000.00,400.00,1300.00,-700.00,600.00,1400.00),
	array("Lil' Probe Inn",              -90.20,1286.80,-3.00,153.80,1554.10,200.00),
	array("Linden Side",                 2749.90,943.20,-89.00,2923.30,1198.90,110.90),
	array("Linden Station",              2749.90,1198.90,-89.00,2923.30,1548.90,110.90),
	array("Linden Station",              2811.20,1229.50,-39.50,2861.20,1407.50,60.40),
	array("Little Mexico",               1701.90,-1842.20,-89.00,1812.60,-1722.20,110.90),
	array("Little Mexico",               1758.90,-1722.20,-89.00,1812.60,-1577.50,110.90),
	array("Los Flores",                  2581.70,-1393.40,-89.00,2747.70,-1135.00,110.90),
	array("Los Flores",                  2581.70,-1454.30,-89.00,2632.80,-1393.40,110.90),
	array("Marina",                      647.70,-1577.50,-89.00,807.90,-1416.20,110.90),
	array("Marina",                      647.70,-1804.20,-89.00,851.40,-1577.50,110.90),
	array("Marina",                      807.90,-1577.50,-89.00,926.90,-1416.20,110.90),
	array("Market Station",              787.40,-1410.90,-34.10,866.00,-1310.20,65.80),
	array("Market",                      1072.60,-1416.20,-89.00,1370.80,-1130.80,110.90),
	array("Market",                      787.40,-1416.20,-89.00,1072.60,-1310.20,110.90),
	array("Market",                      926.90,-1577.50,-89.00,1370.80,-1416.20,110.90),
	array("Market",                      952.60,-1310.20,-89.00,1072.60,-1130.80,110.90),
	array("Martin Bridge",               -222.10,293.30,0.00,-122.10,476.40,200.00),
	array("Missionary Hill",             -2994.40,-811.20,0.00,-2178.60,-430.20,200.00),
	array("Montgomery Section",     		1546.60,208.10,0.00,1745.80,347.40,200.00),
	array("Montgomery Section",     		1582.40,347.40,0.00,1664.60,401.70,200.00),
	array("Montgomery",                  1119.50,119.50,-3.00,1451.40,493.30,200.00),
	array("Montgomery",                  1451.40,347.40,-6.10,1582.40,420.80,200.00),
	array("Mulholland Section",     		1463.90,-1150.80,-89.00,1812.60,-768.00,110.90),
	array("Mulholland",                  1096.40,-910.10,-89.00,1169.10,-768.00,110.90),
	array("Mulholland",                  1169.10,-910.10,-89.00,1318.10,-768.00,110.90),
	array("Mulholland",                  1269.10,-768.00,-89.00,1414.00,-452.40,110.90),
	array("Mulholland",                  1281.10,-452.40,-89.00,1641.10,-290.90,110.90),
	array("Mulholland",                  1318.10,-910.10,-89.00,1357.00,-768.00,110.90),
	array("Mulholland",                  1357.00,-926.90,-89.00,1463.90,-768.00,110.90),
	array("Mulholland",                  1414.00,-768.00,-89.00,1667.60,-452.40,110.90),
	array("Mulholland",                  687.80,-860.60,-89.00,911.80,-768.00,110.90),
	array("Mulholland",                  737.50,-768.00,-89.00,1142.20,-674.80,110.90),
	array("Mulholland",                  768.60,-954.60,-89.00,952.60,-860.60,110.90),
	array("Mulholland",                  861.00,-674.80,-89.00,1156.50,-600.80,110.90),
	array("Mulholland",                  911.80,-860.60,-89.00,1096.40,-768.00,110.90),
	array("Mulholland",                  952.60,-937.10,-89.00,1096.40,-860.60,110.90),
	array("North Rock",                  2285.30,-768.00,0.00,2770.50,-269.70,200.00),
	array("Ocean Docks",                 2089.00,-2394.30,-89.00,2201.80,-2235.80,110.90),
	array("Ocean Docks",                 2201.80,-2418.30,-89.00,2324.00,-2095.00,110.90),
	array("Ocean Docks",                 2201.80,-2730.80,-89.00,2324.00,-2418.30,110.90),
	array("Ocean Docks",                 2324.00,-2145.10,-89.00,2703.50,-2059.20,110.90),
	array("Ocean Docks",                 2324.00,-2302.30,-89.00,2703.50,-2145.10,110.90),
	array("Ocean Docks",                 2373.70,-2697.00,-89.00,2809.20,-2330.40,110.90),
	array("Ocean Docks",                 2703.50,-2302.30,-89.00,2959.30,-2126.90,110.90),
	array("Ocean Flats",                 -2994.40,-222.50,-0.00,-2593.40,277.40,200.00),
	array("Ocean Flats",                 -2994.40,-430.20,-0.00,-2831.80,-222.50,200.00),
	array("Ocean Flats",                 -2994.40,277.40,-9.10,-2867.80,458.40,200.00),
	array("Octane Springs",              338.60,1228.50,0.00,664.30,1655.00,200.00),
	array("Old Venturas Strip",          2162.30,2012.10,-89.00,2685.10,2202.70,110.90),
	array("Palisades",                   -2994.40,458.40,-6.10,-2741.00,1339.60,200.00),
	array("Palomino Creek",              2160.20,-149.00,0.00,2576.90,228.30,200.00),
	array("Paradiso",                    -2741.00,793.40,-6.10,-2533.00,1268.40,200.00),
	array("Pershing Square",             1440.90,-1722.20,-89.00,1583.50,-1577.50,110.90),
	array("Pilgrim",                     2437.30,1383.20,-89.00,2624.40,1783.20,110.90),
	array("Pilgrim",                     2624.40,1383.20,-89.00,2685.10,1783.20,110.90),
	array("Pilson Intersection",         1098.30,2243.20,-89.00,1377.30,2507.20,110.90),
	array("Pirates in Men's Pants",      1817.30,1469.20,-89.00,2027.40,1703.20,110.90),
	array("Playa del Seville",           2703.50,-2126.90,-89.00,2959.30,-1852.80,110.90),
	array("Prickle Pine",                1117.40,2507.20,-89.00,1534.50,2723.20,110.90),
	array("Prickle Pine",                1534.50,2583.20,-89.00,1848.40,2863.20,110.90),
	array("Prickle Pine",                1848.40,2553.40,-89.00,1938.80,2863.20,110.90),
	array("Prickle Pine",                1938.80,2624.20,-89.00,2121.40,2861.50,110.90),
	array("Queens",                      -2411.20,373.50,0.00,-2253.50,458.40,200.00),
	array("Queens",                      -2533.00,458.40,0.00,-2329.30,578.30,200.00),
	array("Queens",                      -2593.40,54.70,0.00,-2411.20,458.40,200.00),
	array("Randolph Ind. Estate",        1558.00,596.30,-89.00,1823.00,823.20,110.90),
	array("Redsands East",               1817.30,2011.80,-89.00,2106.70,2202.70,110.90),
	array("Redsands East",               1817.30,2202.70,-89.00,2011.90,2342.80,110.90),
	array("Redsands East",               1848.40,2342.80,-89.00,2011.90,2478.40,110.90),
	array("Redsands West",               1236.60,1883.10,-89.00,1777.30,2142.80,110.90),
	array("Redsands West",               1297.40,2142.80,-89.00,1777.30,2243.20,110.90),
	array("Redsands West",               1377.30,2243.20,-89.00,1704.50,2433.20,110.90),
	array("Redsands West",               1704.50,2243.20,-89.00,1777.30,2342.80,110.90),
	array("Regular Tom",                 -405.70,1712.80,-3.00,-276.70,1892.70,200.00),
	array("Richman",                     225.10,-1292.00,-89.00,466.20,-1235.00,110.90),
	array("Richman",                     225.10,-1369.60,-89.00,334.50,-1292.00,110.90),
	array("Richman",                     321.30,-1044.00,-89.00,647.50,-860.60,110.90),
	array("Richman",                     321.30,-1235.00,-89.00,647.50,-1044.00,110.90),
	array("Richman",                     321.30,-768.00,-89.00,700.70,-674.80,110.90),
	array("Richman",                     321.30,-860.60,-89.00,687.80,-768.00,110.90),
	array("Richman",                     647.50,-1118.20,-89.00,787.40,-954.60,110.90),
	array("Richman",                     647.50,-954.60,-89.00,768.60,-860.60,110.90),
	array("Richman",                     72.60,-1235.00,-89.00,321.30,-1008.10,110.90),
	array("Richman",                     72.60,-1404.90,-89.00,225.10,-1235.00,110.90),
	array("Robada Section",         		-1119.00,1178.90,-89.00,-862.00,1351.40,110.90),
	array("Roca Escalante",              2237.40,2202.70,-89.00,2536.40,2542.50,110.90),
	array("Roca Escalante",              2536.40,2202.70,-89.00,2625.10,2442.50,110.90),
	array("Rockshore East",              2537.30,676.50,-89.00,2902.30,943.20,110.90),
	array("Rockshore West",              1997.20,596.30,-89.00,2377.30,823.20,110.90),
	array("Rockshore West",              2377.30,596.30,-89.00,2537.30,788.80,110.90),
	array("Rodeo",                       225.10,-1501.90,-89.00,334.50,-1369.60,110.90),
	array("Rodeo",                       225.10,-1684.60,-89.00,312.80,-1501.90,110.90),
	array("Rodeo",                       312.80,-1684.60,-89.00,422.60,-1501.90,110.90),
	array("Rodeo",                       334.50,-1406.00,-89.00,466.20,-1292.00,110.90),
	array("Rodeo",                       334.50,-1501.90,-89.00,422.60,-1406.00,110.90),
	array("Rodeo",                       422.60,-1570.20,-89.00,466.20,-1406.00,110.90),
	array("Rodeo",                       422.60,-1684.60,-89.00,558.00,-1570.20,110.90),
	array("Rodeo",                       466.20,-1385.00,-89.00,647.50,-1235.00,110.90),
	array("Rodeo",                       466.20,-1570.20,-89.00,558.00,-1385.00,110.90),
	array("Rodeo",                       558.00,-1684.60,-89.00,647.50,-1384.90,110.90),
	array("Rodeo",                       72.60,-1544.10,-89.00,225.10,-1404.90,110.90),
	array("Rodeo",                       72.60,-1684.60,-89.00,225.10,-1544.10,110.90),
	array("Royal Casino",                2087.30,1383.20,-89.00,2437.30,1543.20,110.90),
	array("San Andreas Sound",           2450.30,385.50,-100.00,2759.20,562.30,200.00),
	array("Santa Flora",                 -2741.00,458.40,-7.60,-2533.00,793.40,200.00),
	array("Santa Maria Beach",           342.60,-2173.20,-89.00,647.70,-1684.60,110.90),
	array("Santa Maria Beach",           72.60,-2173.20,-89.00,342.60,-1684.60,110.90),
	array("Shady Cabin",                 -1632.80,-2263.40,-3.00,-1601.30,-2231.70,200.00),
	array("Shady Creeks",                -1820.60,-2643.60,-8.00,-1226.70,-1771.60,200.00),
	array("Shady Creeks",                -2030.10,-2174.80,-6.10,-1820.60,-1771.60,200.00),
	array("Sobell Rail Yards",           2749.90,1548.90,-89.00,2923.30,1937.20,110.90),
	array("Spinybed",                    2121.40,2663.10,-89.00,2498.20,2861.50,110.90),
	array("Starfish Casino",             2162.30,1883.20,-89.00,2437.30,2012.10,110.90),
	array("Starfish Casino",             2437.30,1783.20,-89.00,2685.10,2012.10,110.90),
	array("Starfish Casino",             2437.30,1858.10,-39.00,2495.00,1970.80,60.90),
	array("Temple",                      1096.40,-1026.30,-89.00,1252.30,-910.10,110.90),
	array("Temple",                      1096.40,-1130.80,-89.00,1252.30,-1026.30,110.90),
	array("Temple",                      1252.30,-1026.30,-89.00,1391.00,-926.90,110.90),
	array("Temple",                      1252.30,-1130.80,-89.00,1378.30,-1026.30,110.90),
	array("Temple",                      1252.30,-926.90,-89.00,1357.00,-910.10,110.90),
	array("Temple",                      952.60,-1130.80,-89.00,1096.40,-937.10,110.90),
	array("The Camel's Toe",             2087.30,1203.20,-89.00,2640.40,1383.20,110.90),
	array("The Clown's Pocket",          2162.30,1783.20,-89.00,2437.30,1883.20,110.90),
	array("The Emerald Isle",            2011.90,2202.70,-89.00,2237.40,2508.20,110.90),
	array("The Farm",                    -1209.60,-1317.10,114.90,-908.10,-787.30,251.90),
	array("The High Roller",             1817.30,1283.20,-89.00,2027.30,1469.20,110.90),
	array("The Mako Span",               1664.60,401.70,0.00,1785.10,567.20,200.00),
	array("The Panopticon",              -947.90,-304.30,-1.10,-319.60,327.00,200.00),
	array("The Pink Swan",               1817.30,1083.20,-89.00,2027.30,1283.20,110.90),
	array("The Sherman Dam",             -968.70,1929.40,-3.00,-481.10,2155.20,200.00),
	array("The Strip",                   2027.40,1703.20,-89.00,2137.40,1783.20,110.90),
	array("The Strip",                   2027.40,1783.20,-89.00,2162.30,1863.20,110.90),
	array("The Strip",                   2027.40,863.20,-89.00,2087.30,1703.20,110.90),
	array("The Strip",                   2106.70,1863.20,-89.00,2162.30,2202.70,110.90),
	array("The Visage",                  1817.30,1703.20,-89.00,2027.40,1863.20,110.90),
	array("The Visage",                  1817.30,1863.20,-89.00,2106.70,2011.80,110.90),
	array("Unity Station",               1692.60,-1971.80,-20.40,1812.60,-1932.80,79.50),
	array("Valle Ocultado",              -936.60,2611.40,2.00,-715.90,2847.90,200.00),
	array("Verdant Bluffs",              1073.20,-2006.70,-89.00,1249.60,-1842.20,110.90),
	array("Verdant Bluffs",              1249.60,-2179.20,-89.00,1692.60,-1842.20,110.90),
	array("Verdant Bluffs",              930.20,-2488.40,-89.00,1249.60,-2006.70,110.90),
	array("Verdant Meadows",             37.00,2337.10,-3.00,435.90,2677.90,200.00),
	array("Verona Beach",                1046.10,-1722.20,-89.00,1161.50,-1577.50,110.90),
	array("Verona Beach",                1161.50,-1722.20,-89.00,1323.90,-1577.50,110.90),
	array("Verona Beach",                647.70,-2173.20,-89.00,930.20,-1804.20,110.90),
	array("Verona Beach",                851.40,-1804.20,-89.00,1046.10,-1577.50,110.90),
	array("Verona Beach",                930.20,-2006.70,-89.00,1073.20,-1804.20,110.90),
	array("Vinewood",                    647.50,-1227.20,-89.00,787.40,-1118.20,110.90),
	array("Vinewood",                    647.70,-1416.20,-89.00,787.40,-1227.20,110.90),
	array("Vinewood",                    787.40,-1130.80,-89.00,952.60,-954.60,110.90),
	array("Vinewood",                    787.40,-1310.20,-89.00,952.60,-1130.80,110.90),
	array("Whitewood Estates",           1098.30,1726.20,-89.00,1197.30,2243.20,110.90),
	array("Whitewood Estates",           883.30,1726.20,-89.00,1098.30,2507.20,110.90),
	array("Willowfield",                 1970.60,-2179.20,-89.00,2089.00,-1852.80,110.90),
	array("Willowfield",                 2089.00,-1989.90,-89.00,2324.00,-1852.80,110.90),
	array("Willowfield",                 2089.00,-2235.80,-89.00,2201.80,-1989.90,110.90),
	array("Willowfield",                 2201.80,-2095.00,-89.00,2324.00,-1989.90,110.90),
	array("Willowfield",                 2324.00,-2059.20,-89.00,2541.70,-1852.80,110.90),
	array("Willowfield",                 2541.70,-1941.40,-89.00,2703.50,-1852.80,110.90),
	array("Willowfield",                 2541.70,-2059.20,-89.00,2703.50,-1941.40,110.90),
	array("Yellow Bell Station",         1377.40,2600.40,-21.90,1492.40,2687.30,78.00),
	array("The Big Ear",	                -410.00,1403.30,-3.00,-137.90,1681.20,200.00),

	// Main Zones
	array("Bone County",                 -480.50,596.30,-242.90,869.40,2993.80,900.00),
	array("Flint County",                -1213.90,-2892.90,-242.90,44.60,-768.00,900.00),
	array("Las Venturas",                869.40,596.30,-242.90,2997.00,2993.80,900.00),
	array("Los Santos",                  44.60,-2892.90,-242.90,2997.00,-768.00,900.00),
	array("Red County",                  -1213.90,-768.00,-242.90,2997.00,596.30,900.00),
	array("San Fierro",                  -2997.40,-1115.50,-242.90,-1213.90,1659.60,900.00),
	array("Tierra Robada",               -1213.90,596.30,-242.90,-480.50,1659.60,900.00),
	array("Tierra Robada",               -2997.40,1659.60,-242.90,-480.50,2993.80,900.00),
	array("Whetstone",                   -2997.40,-2892.90,-242.90,-1213.90,-1115.50,900.00)
);

function returnStreet($x, $y, $streets) 
{
	for($i = 0; $i != 60; ++$i)
	{
		if($x >= $streets[$i][1] && $x <= $streets[$i][3] && $y >= $streets[$i][2] && $y <= $streets[$i][4])
		{
			return $streets[$i][0];
		}
	} 
	
	return "Unknown";
}

function qomaLokacionin($x, $y, $zonat) 
{
	for($i = 0; $i != 366; ++$i)
	{
		if($x >= $zonat[$i][1] && $x <= $zonat[$i][4] && $y >= $zonat[$i][2] && $y <= $zonat[$i][5])
		{
			return $zonat[$i][0];
		}
	} 
	
	return "Unknown";
}

function GetCity($x, $y, $cities)
{
	for($i = 0; $i != 8; ++$i)
	{
        if($x >= $cities[$i][1] && $x <= $cities[$i][4] && $y >= $cities[$i][2] && $y <= $cities[$i][5])
        {
			return $cities[$i][0];
        }
	}
	
	return "Unknown";
}
 
function adminatOnline($link)
{
	$user_check_query = "SELECT `ID` FROM `characters` WHERE `Online` = 1 AND `Admin` > 0";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;	
	mysqli_free_result($res);
	return $rowcount;
}

function testeratOnline($link)
{
	$user_check_query = "SELECT `ID` FROM `characters` WHERE `Online` = 1 AND `Admin` = -1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
	mysqli_free_result($res);	
	return $rowcount;
}

function ReturnForumData($username)
{
	$OutputData['user_id'] = -1;
	$OutputData['username'] = "N/A";
	$OutputData['user_colour'] = 'FFFFFF';
	$OutputData['user_avatar'] = 'FFFFFF';
	
	$temp_connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, "forum");

	if($link === false)
	{
		return $OutputData;
	}		
	
	$user_check_query = "SELECT `user_id`, `username`, `user_colour`, `user_avatar` FROM `phpbb_users` WHERE `username` = '$username' OR `username_clean` = '$username' LIMIT 1";
	$temp_result = mysqli_query($temp_connection, $user_check_query);	
	
	$rowcount = $temp_result->num_rows;
	
	if($rowcount > 0)
	{
		$data = mysqli_fetch_array($temp_result, MYSQLI_ASSOC);
		
		$OutputData['user_id'] = $data['user_id'];
		$OutputData['username'] = $data['username'];
		$OutputData['user_colour'] = $data['user_colour'];
		$OutputData['user_avatar'] = $data['user_avatar'];
		
		mysqli_free_result($temp_result);
	}
	
	mysqli_close($temp_connection);
	
	return $OutputData;
}

function averageHours($link, $username)
{
	$date = new DateTime(); // For today/now, don't pass an arg.
	$current_date = $date->format("Y-m-d");// H:i:s
						
	$date->modify("-30 days");
	$old_date = $date->format("Y-m-d");// H:i:s	
						
	$user_check_query = "SELECT `stamp`, `disconnected` FROM `logs_connection` WHERE `master` = '$username' AND `stamp` >= '$old_date' AND `stamp` <= '$current_date' ORDER BY `id` DESC";
	$result = mysqli_query($link, $user_check_query);

	$rowcount = $result->num_rows;

	$hours_array = array(); 
											
	$hours_array_str = array(); 
											
	for($i = 0; $i < 30; ++$i)
	{
		$hours_array[$i] = 0;
												
		$hours_array_str[$i] = "00:00:00";
	}
											
	$count = 0;

	if($rowcount > 0)
	{
		while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{													
			$stamp = $result2['stamp'];
			$disconnected = $result2['disconnected'];
													
			$length = strtotime($disconnected) - strtotime($stamp);
													
			if($length < 1) $length = " - ";
													
			$count++;

			$stamp2 = date('Y-m-d', strtotime($stamp));
													
			for($i = 0; $i < 30; ++$i)
			{														
				$date = new DateTime();														
				$date->modify("-$i days");		
				$the_date = $date->format("Y-m-d");		
														
				if($stamp2 == $the_date)
				{															
					$hours_array[$i] += $length;
					$test = $hours_array[$i];
					$hours = floor($test / 3600);
					$minutes = floor(($test / 60) % 60);
					$seconds = $test % 60;
					$hours_array_str[$i] = "$hours:$minutes:$seconds";															
					break;
				}													
			}
		}
												
		$seconds = 0;
		
		foreach($hours_array_str as $hours) 
		{
			$exp = explode(':', strval($hours));
			$seconds += $exp[0]*60*60 + $exp[1]*60 + $exp[2];
		}

		$average = $seconds/sizeof( $hours_array_str );
		$avg = floor($average/3600).'.'.floor(($average%3600)/60); //.'.'.($average%3600)%60;
		
		return $avg;
	}
	else return 0.0;
}

function returnActivityIcon($avg)
{
	if($avg <= 0.0) $icon = "color-tomato fa fa-battery-slash";
	else if($avg > 0.0 && $avg <= 1.0) $icon = "color-tomato fa fa-battery-empty";
	else if($avg > 1.0 && $avg <= 2.0) $icon = "color-blue fa fa-battery-quarter";
	else if($avg > 2.0 && $avg <= 3.0) $icon = "color-blue fa fa-battery-half";
	else if($avg > 3.0 && $avg <= 4.0) $icon = "color-green fa fa-battery-three-quarters";	
	else if($avg > 4.0) $icon = "color-green fa fa-battery-full";
	else $icon = "color-tomato fa fa-battery-slash"; 
	
	return $icon;
}

function convertSeconds($sec_var)
{
	$hours = floor($sec_var / 3600);
	$minutes = floor(($sec_var / 60) % 60);
	$seconds = $sec_var % 60;
	
	$convert_time = "$hours hours, $minutes minutes, $seconds seconds";
	return $convert_time;
}

function convertSeconds_ver2($sec_var)
{
	$hours = floor($sec_var / 3600);
	$minutes = floor(($sec_var / 60) % 60);
	$seconds = $sec_var % 60;
	
	$convert_time = "$seconds seconds";
	
	if($minutes > 0) $convert_time = "$minutes minutes, " . $convert_time;
	
	if($hours > 0) $convert_time = "$hours hours, " . $convert_time;

	return $convert_time;
}

function lojtaretOnline($link)
{
	$user_check_query = "SELECT `char_name` FROM `characters` WHERE `Online` = 1 AND `Admin` = 0";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
	mysqli_free_result($res);	
	return $rowcount;
}

function playerCharacters($link, $master)
{
	$user_check_query = "SELECT `ID` FROM `characters` WHERE `master` = '$master' LIMIT 6";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
	mysqli_free_result($res);	
	return $rowcount;
}

function containsWord($str, $word)
{
    return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
}

function insertNotification($link, $master, $title, $body, $sender)
{
	$title = mysqli_escape_string($link, $title);
	$body = mysqli_escape_string($link, $body);
	
	$user_check_query = "INSERT INTO `notifications` (master, title, body, sender) VALUES ('$master', '$title', '$body', '$sender')";
	$res = mysqli_query($link, $user_check_query);
}

function returnCharacterID($link, $id)
{
	$user_check_query = "SELECT `ID` FROM `characters` WHERE `char_name` = '$id' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
		
	if($rowcount > 0)
	{
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$useri = $result2['ID'];	
	}
	else $useri = -1;
	
	mysqli_free_result($res);
	return $useri;
}

function returnCharacter($link, $id)
{
	$user_check_query = "SELECT `char_name` FROM `characters` WHERE `ID` = '$id' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
		
	if($rowcount > 0)
	{
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$useri = $result2['char_name'];	
	}
	else $useri = "Invalid";
	
	mysqli_free_result($res);
	return $useri;
}

function returnMaster($link, $id)
{
	$user_check_query = "SELECT `Username` FROM `accounts` WHERE `ID` = '$id' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
		
	if($rowcount > 0)
	{
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$useri = $result2['Username'];	
	}
	else $useri = "Invalid";
	
	mysqli_free_result($res);
	return $useri;
}

function returnFactionLeader($link, $id)
{
	$user_check_query = "SELECT `char_name` FROM `characters` WHERE `Faction` = '$id' AND `FactionRank` = '1' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
		
	if($rowcount > 0)
	{
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$useri = $result2['char_name'];	
	}
	else $useri = "Nobody";
	
	mysqli_free_result($res);
	return $useri;
}

function returnFactionName($link, $factionid)
{
	$user_check_query = "SELECT `factionName` FROM `factions` WHERE `factionID` = '$factionid' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
		
	if($rowcount > 0)
	{
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$returnName = $result2['factionName'];	
	}
	else $returnName = "N/A";
	
	mysqli_free_result($res);
	return $returnName;	
}

function returnFactionRank($link, $factionid, $factionrank)
{
	$user_check_query = "SELECT `factionRank$factionrank` FROM `factions` WHERE `factionID` = '$factionid' LIMIT 1";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
		
	if($rowcount > 0)
	{
		$result2 = mysqli_fetch_array($res, MYSQLI_ASSOC);
		$returnRank = $result2["factionRank$factionrank"];	
	}
	else $returnRank = "N/A";
	
	mysqli_free_result($res);
	return $returnRank;	
}

function substrstr($orig, $startText, $endText) 
{
    //get first occurrence of the start string
    $start = strpos($orig, $startText);
    //get last occurrence of the end string
    $end = strrpos($orig, $endText);
    if($start === FALSE || $end === FALSE)
        return $orig;
    $start++;
    $length = $end - $start;
    return substr($orig, $start, $length);
}

function similarApplication($link, $story, $sqlid)
{
	mysqli_escape_string($link, $story);
	
	$similar_app = -1;
	
	$game = explode('.', $story);
	
	for($i = 0; $i < count($game); ++$i)
	{
		if(strlen($game[$i]) < 3)
		{
			unset($game[$i]);
		}
	}
	
	$random_sentence = array
	(
		-1,
		-1,
		-1,
		-1
	);
	
	if(count($game) < 5) $max_sentences = intval(count($game) / 2);
	else $max_sentences = 4;

	for($test = 0; $test < $max_sentences; $test++)
	{
		$found_sentence = rand(0, (count($game)-1));
		
		while($random_sentence[0] == $found_sentence || $random_sentence[1] == $found_sentence || $random_sentence[2] == $found_sentence || $random_sentence[3] == $found_sentence || strlen($game[ $found_sentence ]) < 3)
		{
			$found_sentence = rand(0, (count($game)-1));					
		}
		
		$random_sentence[$test] = $found_sentence;
	}
	
	$user_check_query = "SELECT ID FROM application WHERE ID != '$sqlid' AND story";
	
	for($found = 0; $found < $max_sentences; $found++)
	{
		$sentence_idx = $game[ $random_sentence[$found] ];
		
		$sentence_idx = mysqli_escape_string($link, $sentence_idx);
		
		if($found == 0)
		{
			$user_check_query .= " LIKE '%$sentence_idx%'";
		}
		else
		{
			$user_check_query .= " AND story LIKE '%$sentence_idx%'";			
		}
	}
	
	$user_check_query .= " LIMIT 1";
	
	$result = mysqli_query($link, $user_check_query);	
	$rowcount = $result->num_rows;	
	
	if($rowcount != 0)
	{
		$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$similar_app = $result2['ID'];		
	}
	
	mysqli_free_result($result);
	
	return $similar_app;
}

function isUsingProxy($ip_address) 
{
	$ports = array(80, 81, 553, 554, 1080, 3128, 4480, 6588, 8000, 8080);

	foreach ($ports as $port) 
	{
		if (@fsockopen($ip_address, $port, $errno, $errstr, 5)) 
		{
			return true;
		}
	} 
	
	return false;
}

function friendCount($link, $master)
{
	$user_check_query = "SELECT ID FROM ucp_friends WHERE playerID = '$master'";
	$res = mysqli_query($link, $user_check_query);
	
	$rowcount = $res->num_rows;
	
	mysqli_free_result($res);
	return $rowcount;
}

function playerHasCharacter($character)
{
	$chars = $_SESSION['characters'];
	
	for($i = 0; $i < 6; ++$i)
	{
		if($chars[$i][1] == -1) continue;
		
		if($chars[$i][1] == $character)
		{
			return true;
		}
	}
	
	return false;	
}

function playerVariableCharacters()
{
	$chars = $_SESSION['characters'];
	
	$count = 0;
	
	for($i = 0; $i < 5; ++$i)
	{
		if($chars[$i][1] != -1)
		{
			$count++;
		}
	}
	
	return $count;
}

function updateCharacters($link, $master)
{
	$chars = array
	( 
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0),
		array("N/A", -1, 0)
	);		
		
	$user_check_query = "SELECT `ID`, `char_name`, `Model` FROM `characters` WHERE `master` = '$master' LIMIT 6";
	$result = mysqli_query($link, $user_check_query);
				
	$count = 0;
				
	while($result2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$emri = $result2['char_name'];
		$playid = $result2['ID'];
		$Model = $result2['Model'];
					
		$chars[$count][0] = $emri;
		$chars[$count][1] = $playid;
		$chars[$count][2] = $Model;
					
		$count++;
	}
				
	mysqli_free_result($result);
		
	$_SESSION['characters'] = $chars;
}

function returnBusinessType($type)
{
	switch($type)
	{
		case 1: return "Gas Station";
		case 2: return "Ammunation";
		case 3: return "24/7";
		case 4: return "Vehicle Dealership";
		case 5: return "Car Modding Shop";
		case 6: return "Pay & Spray";
		case 7: return "Clothing Shop";
		case 8: return "Bars";
		case 9: return "Restaurant";
		case 10: return "Furniture Shop";
		case 11: return "Advertisement Center";
		case 12: return "Bank";	
	}
	
	return "Unknown";
}

function returnName($name)
{
	for($i = 0; $i < strlen($name); ++$i)
	{
		if($name[$i] == "_")
		{
			$name[$i] = " ";
		}
	}
	
	return $name;
}

function returnIpAddress()
{
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
	else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
	else
	{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$weapon_names = array
(
	"Fist", "Brass Knuckles", "Golf Club", "Nightstick", "Knife", "Baseball Bat",
	"Shovel", "Pool Cue", "Katana", "Chainsaw", "Double-ended Dilde", "Dildo",
	"Vibrator", "Silver Vibrator", "Flowers", "Cane", "Grenade", "Tear Gas",
	"Molotov Cocktail", "Unknow", "Unknown", "Unknown", "9mm", "Silenced 9mm",
	"Desert Eagle", "Shotgun", "Sawnoff Shotgun", "Combat Shotgun", "Micro SMG",
	"MP5", "AK-47", "M4", "Tec-9", "Country Rifle", "Sniper Rifle", "RPG", "HS Rocket",
	"Flamethrower", "Minigun", "Satchel Charge", "Detonator", "Spraycan", "Fire Extinguisher",
	"Camera", "Night Vis Goggles", "Thermal Goggles", "Parachute", "Fake Pistol", "Unknown",
	"Vehicle", "Helicopter Blades", "Explosion", "Unkown", "Drowned", "Spat"
); 

function ReturnPlayerRank($adminlvl)
{
	switch($adminlvl)
	{
		case -1:
		{
			$player_rank = "Tester Team";
			break;				
		}
		case 0:
		{
			$player_rank = "Normal User";
			break;				
		}
		case 1:
		{
			$player_rank = "Level 1 Game Admin";
			break;			
		}
		case 2:
		{
			$player_rank = "Level 2 Game Admin";
			break;				
		}
		case 3:
		{
			$player_rank = "Level 3 Game Admin";
			break;				
		}
		case 4:
		{
			$player_rank = "Lead Admin";
			break;				
		}
		case 1337:
		{
			$player_rank = "Management";
			break;
		}
	}
	
	return $player_rank;
}

function returnDonatorRank($rank)
{
	$donator_rank = "None";
	
	switch($rank)
	{
		case 0:
		{
			$donator_rank = "None";
			break;
		}
		case 1:
		{
			$donator_rank = "Bronze";
			break;
		}
		case 2:
		{
			$donator_rank = "Silver";
			break;
		}
		case 3:
		{
			$donator_rank = "Gold";
			break;
		}
	}
	
	return $donator_rank;
}

function characterCount($string, $character)
{
	$count = 0;
	
	for($i = 0; $i < strlen($string); ++$i)
	{
		if($string[$i] == $character)
		{
			if($character == ".")
			{
				if($i + 1 != strlen($string))
				{
					if($string[$i + 1] != ".")
					{
						$count++;
					}
				}
				else $count++;
			}
			else
			{
				$count++;
			}
		}
	}
	
	return $count;
}

function playerRank($username, $alevel)
{
	if($username == "cuesta") return "Developers";
	
	switch($alevel)
	{
		case -1:
		{
			$playerRank = "Tester Team";
			break;
		}
		case 0:
		{
			$playerRank = "Regular Player";
			break;			
		}
		case 1:
		{
			$playerRank = "Administrator";
			break;		
		}
		case 2:
		{
			$playerRank = "Administrator";
			break;			
		}
		case 3:
		{
			$playerRank = "Administrator";
			break;			
		}
		case 4:
		{
			$playerRank = "Administrator";
			break;			
		}
		case 1337:
		{
			$playerRank = "Management";
			break;			
		}
	}

	return $playerRank;
}

function issueBan($link, $master, $bannedBy, $reason, $playerIP, $perm)
{
	//$master = mysqli_escape_string($link, $master);
	//$bannedBy = mysqli_escape_string($link, $bannedBy);
	$reason = mysqli_escape_string($link, $reason);
	//$playerIP = mysqli_escape_string($link, $playerIP);	
	
	$user_check_query = "INSERT INTO bans (name, bannedby, reason, playerIP, perm) VALUES ('$master', '$bannedBy', '$reason', '$playerIP', '$perm')";
	$result = mysqli_query($link, $user_check_query);

	mysqli_free_result($result);
}

function insertBanLog($link, $playerIP, $playerName, $bannedBy, $reason, $masterID)
{
	/*$playerIP = mysqli_escape_string($link, $playerIP);
	$playerName = mysqli_escape_string($link, $playerName);
	$bannedBy = mysqli_escape_string($link, $bannedBy);*/
	$reason = mysqli_escape_string($link, $reason);
	
	$user_check_query = "INSERT INTO logs_ban (`IP`, `Character`, `BannedBy`, `Reason`, `user_id`) VALUES ('$playerIP', '$playerName', '$bannedBy', '$reason', '$masterID')";
	$result = mysqli_query($link, $user_check_query);

	mysqli_free_result($result);
}

function accountsCount($link)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM accounts";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function factionVehiclesCount($link, $faction_id)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM vehicles WHERE vehicleFaction = '$faction_id'";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function housesCount($link)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM houses";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function vehiclesCount($link)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM cars";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function businessesCount($link)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM business";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function banCount($link)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM bans";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function charactersCount($link)
{
	$user_check_query = "SELECT COUNT(*) AS total FROM characters";
	$result = mysqli_query($link, $user_check_query);
	
	$result2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = $result2['total'];

	mysqli_free_result($result);
	return $count;
}

function TimestampToDate($stamp)
{
	$time = date('d-m-Y : h:i:s', $stamp);
	
	return $time;
}

function Discord_AlertStaff($message)
{
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/Msg.php"); 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/DiscordMsg.php"); 
	
	$discord_message = new \AG\DiscordMsg($message);
	$discord_message->send();	
}

function applicationStatus($status, $accepted)
{
	$status_str = "N/A";
	
	switch($status)
	{
		case 0:
		{
			$status_str = "Pending";
			break;
		}
		case 1:
		{
			$status_str = "Reviewing";
			break;
		}
		case 2:
		{
			switch($accepted)
			{
				case 1:
				{
					$status_str = "Accepted";
					break;
				}
				case 2:
				{
					$status_str = "Denied and Banned";
					break;
				}
				default:
				{
					$status_str = "Denied";
					break;
				}
			}
			break;
		}
	}
	
	return $status_str;
}

function apiRequest_custom($url, $auth_token, $post=FALSE, $headers=array()) 
{
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	$response = curl_exec($ch);
	
	if($post)
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

	$headers[] = 'Accept: application/json';
	$headers[] = 'Authorization: Bearer ' . $auth_token;

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$response = curl_exec($ch);
	
	return json_decode($response);
}

function apiRequest($url, $post=FALSE, $headers=array()) 
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	$response = curl_exec($ch);

	if($post)
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

	$headers[] = 'Accept: application/json';

	if(session('discord_auth'))
	  $headers[] = 'Authorization: Bearer ' . session('discord_auth');

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	 $response = curl_exec($ch);
	 return json_decode($response);
}

function get($key, $default=NULL) 
{
	return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) 
{
	return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

function valid_email($email) 
{
    if(is_array($email) || is_numeric($email) || is_bool($email) || is_float($email) || is_file($email) || is_dir($email) || is_int($email))
	{
        return false;
	}
    else
    {
        $email = trim(strtolower($email));
		
        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false) 
		{
			return $email;
		}
        else
        {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            return (preg_match($pattern, $email) === 1) ? $email : false;
        }
    }
}

function isMobile() 
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getOS() 
{ 
    global $user_agent;

    $os_platform = "Unknown OS Platform";

    $os_array = array
	(
		'/windows nt 10/i'      =>  'Windows 10',
		'/windows nt 6.3/i'     =>  'Windows 8.1',
		'/windows nt 6.2/i'     =>  'Windows 8',
		'/windows nt 6.1/i'     =>  'Windows 7',
		 '/windows nt 6.0/i'     =>  'Windows Vista',
		'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     =>  'Windows XP',
		'/windows xp/i'         =>  'Windows XP',
		'/windows nt 5.0/i'     =>  'Windows 2000',
		'/windows me/i'         =>  'Windows ME',
		'/win98/i'              =>  'Windows 98',
		'/win95/i'              =>  'Windows 95',
		'/win16/i'              =>  'Windows 3.11',
		'/macintosh|mac os x/i' =>  'Mac OS X',
		'/mac_powerpc/i'        =>  'Mac OS 9',
		'/linux/i'              =>  'Linux',
		'/ubuntu/i'             =>  'Ubuntu',
		'/iphone/i'             =>  'iPhone',
		'/ipod/i'               =>  'iPod',
		'/ipad/i'               =>  'iPad',
		'/android/i'            =>  'Android',
		'/blackberry/i'         =>  'BlackBerry',
		'/webos/i'              =>  'Mobile'
    );

    foreach($os_array as $regex => $value)
	{
        if(preg_match($regex, $user_agent))
		{
            $os_platform = $value;
		}
	}

    return $os_platform;
}

function getBrowser() 
{
    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function returnComponentName($component)
{
    switch($component)
    {
       case 1000: return "Pro Spoiler";
       case 1001: return "Win Spoiler";
       case 1002: return "Drag Spoiler";
       case 1003: return "Alpha Spoiler";
       case 1004: return "Champ Scoop";
       case 1005: return "Fury Scoop";
       case 1006: return "Roof Scoop";
       case 1007: return "Right Sideskirt";
       case 1008: return "Nitrous x5";
       case 1009: return "Nitrous x2";
       case 1010: return "Nitrous x10";
       case 1011: return "Race Scoop";
       case 1012: return "Worx Scoop";
       case 1013: return "Round Fog Lights";
       case 1014: return "Champ Spoiler";
       case 1015: return "Race Spoiler";
       case 1016: return "Worx Spoiler";
       case 1017: return "Left Sideskirt";
       case 1018: return "Upswept Exhaust";
       case 1019: return "Twin Exhaust";
       case 1020: return "Large Exhaust";
       case 1021: return "Medium Exhaust";
       case 1022: return "Small Exhaust";
       case 1023: return "Fury Spoiler";
       case 1024: return "Square Fog Lights";
       case 1025: return "Offroad Wheels";	   	  	   	   
       case 1042: return "Right Chrome Sideskirt";
       case 1099: return "Left Chrome Sideskirt";
       case 1073: return "Shadow Wheels";
       case 1074: return "Mega Wheels";
       case 1075: return "Rimshine Wheels";
       case 1076: return "Wires Wheels";
       case 1077: return "Classic Wheels";
       case 1078: return "Twist Wheels";
       case 1079: return "Cutter Wheels";
       case 1080: return "Stitch Wheels";
       case 1081: return "Grove Wheels";
       case 1082: return "Import Wheels";
       case 1083: return "Dollar Wheels";
       case 1084: return "Trance Wheels";
       case 1085: return "Atomic Wheels";
       case 1086: return "Stereo";
       case 1087: return "Hydraulics";
       case 1096: return "Ahab Wheels";
       case 1097: return "Virtual Wheels";
       case 1098: return "Access Wheels";
       case 1100: return "Chrome Grill";
       case 1101: return "Left Chrome Flames Sideskirt";
       case 1103: return "Convertible Roof";
       case 1109: return "Chrome Rear Bullbars";
       case 1110: return "Slamin Rear Bullbars";
       case 1115: return "Chrome Front Bullbars";
       case 1116: return "Slamin Front Bullbars";
       case 1118: return "Right Chrome Trim Sideskirt";
       case 1119: return "Right Wheelcovers Sideskirt";
       case 1120: return "Left Chrome Trim Sideskirt";
       case 1121: return "Left Wheelcovers Sideskirt";
       case 1122: return "Right Chrome Flames Sideskirt";
       case 1123: return "Bullbar Chrome Bars";
       case 1125: return "Bullbar Chrome Lights";
       case 1128: return "Vinyl Hardtop Roof";
       case 1130: return "Hardtop Roof";
       case 1131: return "Softtop Roof";
       case 1142: return "Left Oval Vents";
       case 1143: return "Right Oval Vents";
       case 1144: return "Left Square Vents";
       case 1145: return "Right Square Vents";
    }
	
	if($component == 1026 || $component == 1036 || $component == 1047 || $component == 1056 || $component == 1069 || $component == 1090) return "Right Alien Sideskirt";
	if($component == 1027 || $component == 1040 || $component == 1051 || $component == 1062 || $component == 1071 || $component == 1094) return "Left Alien Sideskirt";
	if($component == 1028 || $component == 1034 || $component == 1046 || $component == 1064 || $component == 1065 || $component == 1092) return "Alien Exhaust";
	if($component == 1029 || $component == 1037 || $component == 1045 || $component == 1059 || $component == 1066 || $component == 1089) return "X-Flow Exhaust";
	if($component == 1030 || $component == 1039 || $component == 1048 || $component == 1057 || $component == 1070 || $component == 1095) return "Right X-Flow Sideskirt";
    if($component == 1031 || $component == 1041 || $component == 1052 || $component == 1063 || $component == 1072 || $component == 1093) return "Left X-Flow Sideskirt";
    if($component == 1032 || $component == 1038 || $component == 1054 || $component == 1055 || $component == 1067 || $component == 1088) return "Alien Roof Vent";
    if($component == 1033 || $component == 1035 || $component == 1053 || $component == 1061 || $component == 1068 || $component == 1091) return "X-Flow Roof Vent";
    if($component == 1043 || $component == 1105 || $component == 1114 || $component == 1127 || $component == 1132 || $component == 1135) return "Slamin Exhaust";
    if($component == 1044 || $component == 1104 || $component == 1113 || $component == 1126 || $component == 1129 || $component == 1136) return "Chrome Exhaust";
    if($component == 1050 || $component == 1058 || $component == 1139 || $component == 1146 || $component == 1158 || $component == 1163) return "X-Flow Spoiler";
    if($component == 1049 || $component == 1060 || $component == 1138 || $component == 1147 || $component == 1162 || $component == 1164) return "Alien Spoiler";	
    if($component == 1117 || $component == 1174 || $component == 1179 || $component == 1182 || $component == 1189 || $component == 1191) return "Chrome Front Bumper";
    if($component == 1175 || $component == 1181 || $component == 1185 || $component == 1188 || $component == 1190) return "Slamin Front Bumper";
    if($component == 1176 || $component == 1180 || $component == 1184 || $component == 1187 || $component == 1192) return "Chrome Rear Bumper";
    if($component == 1177 || $component == 1178 || $component == 1183 || $component == 1186 || $component == 1193) return "Slamin Rear Bumper";	
    if($component == 1140 || $component == 1148 || $component == 1151 || $component == 1156 || $component == 1161 || $component == 1167) return "X-Flow Rear Bumper";
    if($component == 1141 || $component == 1149 || $component == 1150 || $component == 1154 || $component == 1159 || $component == 1168) return "Alien Rear Bumper";	 
    if($component == 1152 || $component == 1157 || $component == 1165 || $component == 1170 || $component == 1172 || $component == 1173) return "X-Flow Front Bumper";
    if($component == 1153 || $component == 1155 || $component == 1160 || $component == 1166 || $component == 1169 || $component == 1171) return "Alien Front Bumper";
	if($component == 1102 || $component == 1107) return "Left Chrome Strip Sideskirt";	   
    if($component == 1106 || $component == 1124 || $component == 1137) return "Left Chrome Arches Sideskirt";
    if($component == 1108 || $component == 1133 || $component == 1134) return "Right Chrome Strip Sideskirt";
	if($component == 1111 || $component == 1112) return "Front Sign";	
	
	return "Invalid";
}

$drugData = array
(
	array("Cocaine", 0),
	array("Cannabis", 0), 
	array("Xanax", 0), 
	array("MDMA", 1), 
	array("Heroin", 0), 
	array("Ketamine", 0), 
	array("Fentanyl", 1), 
	array("Methamphetamine", 0),
	array("Steroids", 0),
	array("Oxycodone", 0)
);
