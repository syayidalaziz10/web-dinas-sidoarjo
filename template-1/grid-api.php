<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Agenda Sidoarjo</title>
   <style>
      .agenda-item {
         border: 1px solid #ccc;
         padding: 10px;
         margin: 10px 0;
      }

      .agenda-item img {
         max-width: 100%;
         height: auto;
      }
   </style>
</head>

<body>
   <h1>Agenda Sidoarjo</h1>
   <div id="agenda-container"></div>

   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const apiUrl = 'https://www.sidoarjokab.go.id/api/getagenda/20';
         const agendaContainer = document.getElementById('agenda-container');

         fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
               console.log(data); // Untuk debugging
               const agendas = data.data; // Menyesuaikan dengan struktur JSON yang dihasilkan oleh API

               if (agendas && agendas.length > 0) {
                  agendas.forEach(agenda => {
                     const agendaItem = document.createElement('div');
                     agendaItem.className = 'agenda-item';

                     const title = document.createElement('h2');
                     title.textContent = agenda.judul; // Menyesuaikan dengan properti JSON
                     agendaItem.appendChild(title);

                     const date = document.createElement('p');
                     date.textContent = `Tanggal: ${agenda.tanggal}`;
                     agendaItem.appendChild(date);

                     const tglMulai = document.createElement('p');
                     tglMulai.textContent = `Mulai: ${agenda.tgl_mulai}`;
                     agendaItem.appendChild(tglMulai);

                     const tglAkhir = document.createElement('p');
                     tglAkhir.textContent = `Akhir: ${agenda.tgl_akhir}`;
                     agendaItem.appendChild(tglAkhir);

                     if (agenda.gambar) {
                        const image = document.createElement('img');
                        image.src = agenda.gambar;
                        agendaItem.appendChild(image);
                     }

                     const link = document.createElement('a');
                     link.href = agenda.url;
                     link.textContent = 'Lihat Selengkapnya';
                     link.target = '_blank';
                     agendaItem.appendChild(link);

                     agendaContainer.appendChild(agendaItem);
                  });
               } else {
                  agendaContainer.textContent = 'Tidak ada agenda.';
               }
            })
            .catch(error => {
               console.error('Error fetching data:', error);
               agendaContainer.textContent = 'Terjadi kesalahan saat memuat data.';
            });
      });
   </script>
</body>

</html>