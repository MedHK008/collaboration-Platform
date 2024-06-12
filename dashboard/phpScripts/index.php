<?php
require('assets/phpScripts/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin dashboard</title>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <h1>Age Distribution of Collaborators</h1>
    <div id="chart"></div>

    <script>
        // Fetch data from the PHP script
        fetch('assets/phpScripts/collabAge.php')
            .then(response => response.json())
            .then(data => {
                // Set up the chart dimensions
                const margin = {top: 20, right: 30, bottom: 40, left: 40};
                const width = 800 - margin.left - margin.right;
                const height = 400 - margin.top - margin.bottom;

                const svg = d3.select("#chart").append("svg")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", `translate(${margin.left},${margin.top})`);

                const x = d3.scaleBand()
                    .domain(data.map(d => d.age_interval))
                    .range([0, width])
                    .padding(0.1);

                const y = d3.scaleLinear()
                    .domain([0, d3.max(data, d => d.count)])
                    .nice()
                    .range([height, 0]);

                svg.append("g")
                    .selectAll(".bar")
                    .data(data)
                    .enter().append("rect")
                    .attr("class", "bar")
                    .attr("x", d => x(d.age_interval))
                    .attr("y", d => y(d.count))
                    .attr("width", x.bandwidth())
                    .attr("height", d => height - y(d.count))
                    .attr("fill", "steelblue");

                svg.append("g")
                    .attr("class", "x-axis")
                    .attr("transform", `translate(0,${height})`)
                    .call(d3.axisBottom(x));

                svg.append("g")
                    .attr("class", "y-axis")
                    .call(d3.axisLeft(y));
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
    </body>

</html>





