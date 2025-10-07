console.log("test2");
const API_URL = "https://b71016fd-7679-4ab0-a2c4-080bf106a939.mock.pstmn.io/sensor";  // Use your own backend now
console.log("test");
async function loadData() {
  const res = await fetch(API_URL);
  const data = await res.json();
  document.getElementById("water-level").textContent =
    `Water Level: ${data.level || data.value || "N/A"} units`;
    console.log(data);
    console.log("arrived here!")
    console.log(res);
}

loadData();