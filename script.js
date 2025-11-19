async function fetchWater() {
    const res = await fetch("http://127.0.0.1:8000/water"); // fetch sends a HTTP get request to the /water endpoint (listens at 121 whatever endpoint)
    const data = await res.json(); // turns json response into javascript object

    document.getElementById("water-level").textContent = data.water_level ?? "No data yet";
    document.getElementById("timestamp").textContent = data.timestamp ?? "";

}

fetchWater();
// refresh every 10 seconds
setInterval(fetchWater, 10000);