<div class="userMoodPanel">
    <div class="userStatistics">
    <h2>Personal Progress Tracking</h2>
    <?php 

// Fetch mood frequency data from the database
$query = "SELECT mood_tracker.mood, COUNT(*) AS mood_count, mood_options.mood_color 
          FROM mood_tracker 
          JOIN mood_options ON mood_tracker.mood = mood_options.mood_name 
          WHERE mood_tracker.user_id = 2 
          GROUP BY mood_tracker.mood 
          ORDER BY mood_tracker.mood ASC";

$result = $connection->query($query);

$moods = [];
$mood_counts = [];
$mood_colors = [];

// Process the result
while ($row = $result->fetch_assoc()) {
    $moods[] = $row['mood'];
    $mood_counts[] = $row['mood_count'];
    $mood_colors[] = $row['mood_color']; // Colors for each mood
}

// Convert arrays to JSON for JavaScript
$moods_json = json_encode($moods);
$mood_counts_json = json_encode($mood_counts);
$mood_colors_json = json_encode($mood_colors);
?>

<canvas id="moodChart1"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('moodChart1').getContext('2d');

// Inject PHP data into JavaScript
var moodLabels = <?php echo $moods_json; ?>;  // Mood categories
var moodCounts = <?php echo $mood_counts_json; ?>;  // Count of each mood
var moodColors = <?php echo $mood_colors_json; ?>;  // Colors for each mood

var moodChart = new Chart(ctx, {
    type: 'doughnut', // Doughnut chart type
    data: {
        labels: moodLabels, // Mood categories
        datasets: [{
            label: 'Mood Frequency',
            data: moodCounts,  // Count of each mood
            backgroundColor: moodColors,  // Dynamically assigned colors based on mood
            borderColor: moodColors.map(color => color.replace('0.5', '1')), // Solid border colors with opacity replaced
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,  // Enable responsiveness for the chart
        plugins: {
            tooltip: {
                callbacks: {
                    // Display percentage and count in the tooltip
                    label: function(context) {
                        let label = context.label || '';
                        let count = context.raw || 0;
                        let total = context.dataset.data.reduce((acc, value) => acc + value, 0);
                        let percentage = (count / total * 100).toFixed(1);
                        return `${label}: ${count} (${percentage}%)`;
                    }
                }
            },
            legend: {
                display: true, // Show the legend for the doughnut chart
            }
        }
    }
});
</script>

</div>


<!-- bar graph -->
<div class="userStatistics">
<h2>Weekly mood tracking</h2>

<?php 
// Query the database
$query = "SELECT mood_tracker.mood, COUNT(*) AS mood_count, mood_options.mood_color 
          FROM mood_tracker 
          JOIN mood_options ON mood_tracker.mood = mood_options.mood_name 
          WHERE mood_tracker.user_id = 2 
          GROUP BY mood_tracker.mood
          ORDER BY mood_count DESC";
$result = $connection->query($query);

// Prepare data arrays
$moods = [];
$mood_counts = [];
$mood_colors = [];

// Process the result
while ($row = $result->fetch_assoc()) {
    $moods[] = $row['mood']; // Moods for X-axis labels
    $mood_counts[] = $row['mood_count']; // Total occurrences of each mood
    $mood_colors[] = $row['mood_color']; // Colors for the bars
}

// Convert arrays to JSON for JavaScript
$mood_counts_json = json_encode($mood_counts);
$mood_colors_json = json_encode($mood_colors);
$moods_json = json_encode($moods); // Moods for X-axis labels
?>

<canvas id="myMixedChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('myMixedChart').getContext('2d');

// Inject PHP data into JavaScript
var moodCounts = <?php echo $mood_counts_json; ?>;
var moodColors = <?php echo $mood_colors_json; ?>;
var moodLabels = <?php echo $moods_json; ?>; // X-axis labels (moods)

var myMixedChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: moodLabels,  // Use moods as X-axis labels
        datasets: [{
            label: 'Mood Frequency',
            data: moodCounts,  // Total occurrences of each mood
            backgroundColor: moodColors,  // Dynamically assigned colors based on mood
            borderColor: moodColors.map(color => color.replace('0.2', '1')), // Solid border colors
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Frequency'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Moods'
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return moodLabels[tooltipItem.dataIndex] + ': ' + tooltipItem.raw;
                    }
                }
            }
        }
    }
});
</script>




</div>





</div>

