<div class="card">
    <div class="card-header">
	<h2><p class="text-primary m-0 font-weight-bold">Sistem Informasi Pemetaan Laboratorium Dan Ruangan Lingkup PENS</p></h2>
    </div>
    <div class="card-body">
		<div class=" justify-content-center" id="map" style="margin:0 auto; height:100vh; width:100%;"></div>
		<!-- </div> -->
	</div>
</div>

<script>

	var map = L.map('map').setView([-7.276730416931179, 112.79398368529063], 19);

	var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	var marker_gedung_D4 = L.marker([-7.276730416931179, 112.79398368529063]).addTo(map).bindPopup('Gedung D3').openPopup();
	var marker_gedung_D3 = L.marker([-7.276717113899188, 112.79492782282247]).addTo(map).bindPopup('Gedung D4').openPopup();
	var marker_gedung_D3 = L.marker([-7.276945925994565, 112.79309587416766]).addTo(map).bindPopup('Gedung Pasca Sarjana').openPopup();
	var marker_gedung_D3 = L.marker([-7.275873700865577, 112.79451744486612]).addTo(map).bindPopup('Gedung EIC').openPopup();

	// var circle = L.circle([-7.276730416931179, 112.79398368529063], {
	// 	color: 'red',
	// 	fillColor: '#f03',
	// 	fillOpacity: 0.5,
	// 	radius: 100
	// }).addTo(map);

	var gedung_D4 = L.polygon([
		[-7.276272792403976, 112.79528187439266],
		[-7.277241253061443, 112.79522554800647],
		[-7.277214647027344, 112.79458718229661],
		[-7.276272792403976, 112.7945952289232]
		],{
			color: '#53BF9D',
			fillColor: '#D3EBCD',
			fillOpacity: 0.5,
		}).addTo(map);
	
	var gedung_D3 = L.polygon([
		[-7.27614774376013, 112.79451476265726],
		[-7.277222628837746, 112.79446916510655],
		[-7.277230610647995, 112.79350356991515],
		[-7.27691931994296, 112.79352502758607],
		[-7.27689803510053, 112.79328899320593],
		[-7.27674371996279, 112.79328899320593],
		[-7.27674371996279, 112.7934687011999],
		[-7.276451053176462, 112.79346601899103],
		[-7.2764271077036815, 112.79312537846516],
		[-7.276102513391002, 112.7931226962563]
		],{
			color: '#1363DF',
			fillColor: '#47B5FF',
			fillOpacity: 0.5,
		}).addTo(map);
	
	var gedung_D4 = L.polygon([
		[-7.277148131935209, 112.7934847944531],
		[-7.277145471331323, 112.79292957721803],
		[-7.276608029021953, 112.79294298826234],
		[-7.276626653271171, 112.79322193798431],
		[-7.276929962363788, 112.79325144228183],
		[-7.276964550229749, 112.7934767478265]
		],{
			color: '#87805E',
			fillColor: '#B09B71',
			fillOpacity: 0.5,
		}).addTo(map);

	var gedung_eic = L.polygon([
		[-7.276086549730226, 112.79465423751824],
		[-7.275807185574657, 112.7946569197271],
		[-7.275780579455536, 112.79423849514417],
		[-7.2758949857565804, 112.79423849514417],
		[-7.275921591868921, 112.79453085591045],
		[-7.276078567899622, 112.79452280928385]
		],{
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5,
		}).addTo(map);
</script>
