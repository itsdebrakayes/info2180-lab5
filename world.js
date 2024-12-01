document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('lookup').addEventListener('click', function () {
        let country = document.getElementById('country').value;
        fetch(`world.php?country=${country}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('result').innerHTML = data;
            });
    });

    document.getElementById('lookupCities').addEventListener('click', function () {
        let country = document.getElementById('country').value;
        fetch(`world.php?country=${country}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('result').innerHTML = data;
            });
    });
});
