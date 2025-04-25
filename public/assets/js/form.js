var kat_l  = $('#kat_layanan');
var el = $("#nama_layanan");

kat_l.change(function() {
    el.empty(); // remove options
    el.append($("<option disabled selected>pilih satu layanan</option>"));

    switch (kat_l.val()) {
        case '1':
            var newOptions = {
                "Layanan akses jaringan BPS dan koneksi internet": "1",
                "Layanan koneksi VPN": "2",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;

        case '2':
            var newOptions = {
                "Layanan email": "3",
                "Layanan zoom": "4",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;

        case '3':
            var newOptions = {
                "Layanan web hosting": "5",
                "Layanan server hosting": "6",
                "Layanan database hosting": "7",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;

        case '4':
            var newOptions = {
                "Layanan file share storage": "8",
                "Layanan crawling informasi": "9",
                "Layanan pengelolaan data sensus dan survei": "10",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;
    
        case '5':
            var newOptions = {
                "Layanan pengelolaan piranti lunak": "11",
                "Layanan permintaan piranti lunak": "12",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;

        case '6':
            var newOptions = {
                "Layanan PC/Komputer": "13",
                "Layanan Printer & Scanner": "14",
                "Layanan UPS": "15",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;

        case '7':
            var newOptions = {
                "Layanan pembangunan sistem informasi manajemen": "16",
                "Layanan pengembangan sistem informasi manajemen": "17",
                "Layanan pembangunan aplikasi sensus/survei": "18",
                "Layanan pengembangan aplikasi sensus/survei": "19",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;
            
        default:
            var newOptions = {
                "Layanan fasih": "20",
                "Layanan query builder": "21",
                "Layanan konsultasi pengolahan data": "22",
            };

            $.each(newOptions, function(key, value) {
                el.append($("<option></option>")
                    .attr("value", value).text(key));
            });
            break;
    }
})
