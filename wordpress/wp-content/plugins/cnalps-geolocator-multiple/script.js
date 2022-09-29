const src = document.getElementById("cnalps-map").textContent;//récupérer le contenu text de l'id

try {
    fetch(src)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        let map = L.map("cnalps-map").setView([data[0].lat, data[0].lon], 8);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map);

        for (let i = 0; i < data.length; i++){
            L.marker([data[i].lat, data[i].lon]).addTo(map)
            .bindPopup(data[i].title)
            .openPopup();
        }
    }
)} catch (error) {
    console.log("Erreur : ",error);
}