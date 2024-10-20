<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title >News - Hikes and Sports in Lebanon</title>
    <link rel="stylesheet" href="navbar.css"> 

<?php
include("authentication.php");

?>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        

        #search-bar {
            width: 50%;
            /* Adjust the width to be smaller */
            max-width: 400px;
            /* Optional: set a max width */
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            /* Ensure padding doesn't affect total width */
        }

        .news-item {
            background: #fff;
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            transition: background 0.3s;
            cursor: pointer;
        }

        .news-item:hover {
            background: #f1f1f1;
        }

        .news-item img {
            width: 300px;
            height: auto;
            margin-right: 20px;
            border-radius: 5px;
        }

        .news-content {
            display: flex;
            align-items: center;
        }

        .news-summary {
            flex: 1;
        }

        .news-item h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
        }

        .news-item p {
            margin: 0;
            font-size: 0.9em;
            text-align: justify;
        }

        .news-date {
            font-size: 0.8em;
            color: #666;
            margin-bottom: 10px;
        }

        .news-detail {
            display: none;
            margin-top: 10px;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var newsItems = document.querySelectorAll(".news-item");
            newsItems.forEach(function (item) {
                item.addEventListener("click", function () {
                    var detail = this.querySelector(".news-detail");
                    detail.style.display = detail.style.display === "none" ? "block" : "none";
                });
            });

            // Search bar functionality
            document.getElementById('search-bar').addEventListener('input', function () {
                let query = this.value.toLowerCase();
                let items = document.querySelectorAll('.news-item');
                items.forEach(item => {
                    let title = item.querySelector('h2').textContent.toLowerCase();
                    if (title.includes(query)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</head>

<body>
    <header>
        <div style="margin-left:400px" >
            <h1 style="padding-top:50px">Hikes and Sports News in Lebanon</h1>
            <input type="text" id="search-bar" placeholder="Search news...">
        </div>
    </header>
    <div class="container">
        <section id="news">
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/qadisha-valley.jpg" alt="Qadisha Valley">
                    <div class="news-summary">
                        <h2>Exploring the Qadisha Valley</h2>
                        <div class="news-date">Published on: January 5, 2024</div>
                        <p>Qadisha Valley, a UNESCO World Heritage site, offers breathtaking hiking trails that showcase
                            Lebanon's natural beauty and rich history...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>Qadisha Valley, a UNESCO World Heritage site, offers breathtaking hiking trails that showcase
                        Lebanon's natural beauty and rich history. Hikers can enjoy the serene landscape, ancient
                        monasteries, and stunning cliffs. The valley is home to a number of ancient monasteries and
                        hermitages, some of which date back to the early centuries of Christianity. As you hike through
                        the valley, you'll encounter lush greenery, cascading waterfalls, and the peaceful sound of the
                        Qadisha River flowing through the landscape. Whether you're a seasoned hiker or a nature lover,
                        the Qadisha Valley provides an unforgettable experience of Lebanon's natural and cultural
                        heritage.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/cedars-of-god.jpg" alt="Cedars of God">
                    <div class="news-summary">
                        <h2>Adventure at the Cedars of God</h2>
                        <div class="news-date">Published on: January 10, 2024</div>
                        <p>The Cedars of God forest in Bsharri is one of the last vestiges of the extensive forests of
                            the Lebanon Cedar...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>The Cedars of God forest in Bsharri is one of the last vestiges of the extensive forests of the
                        Lebanon Cedar. It provides an excellent opportunity for hiking and enjoying the majestic trees
                        that have stood the test of time. These ancient trees, some of which are over a thousand years
                        old, have been mentioned in various religious and historical texts, symbolizing resilience and
                        longevity. The forest is not only a natural treasure but also a cultural and historical icon of
                        Lebanon. As you explore the trails, you'll be surrounded by the awe-inspiring sight of these
                        towering trees, with their massive trunks and sprawling branches. The area also offers a museum
                        and a small shop where visitors can learn more about the history and significance of the Cedars
                        of God.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/jeita-grotto.jpg" alt="Jeita Grotto">
                    <div class="news-summary">
                        <h2>Discovering the Jeita Grotto</h2>
                        <div class="news-date">Published on: January 15, 2024</div>
                        <p>The Jeita Grotto, a system of two separate, but interconnected, limestone caves, is a
                            must-visit for nature enthusiasts...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>The Jeita Grotto, a system of two separate, but interconnected, limestone caves, is a must-visit
                        for nature enthusiasts. Visitors can take a boat ride through the lower cave and marvel at the
                        stunning formations. The upper cave, accessible by foot, features a well-lit path that guides
                        visitors through an array of stalactites and stalagmites, each uniquely shaped over thousands of
                        years. The Jeita Grotto has been nominated as one of the New7Wonders of Nature, reflecting its
                        global significance and natural beauty. The caves offer a cool respite from the heat, with their
                        naturally maintained temperatures providing a comfortable environment to explore. The
                        surrounding area also features lush gardens and a small zoo, making it an ideal destination for
                        families and nature lovers alike.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/beirut-cycling.jpg" alt="Cycling in Beirut">
                    <div class="news-summary">
                        <h2>Cycling Through Beirut's Coastal Line</h2>
                        <div class="news-date">Published on: January 20, 2024</div>
                        <p>Beirut offers a vibrant coastal line perfect for cycling enthusiasts. The Corniche, a seaside
                            promenade, provides a scenic route...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>Beirut offers a vibrant coastal line perfect for cycling enthusiasts. The Corniche, a seaside
                        promenade, provides a scenic route for cyclists to enjoy the Mediterranean breeze and the city's
                        skyline. This popular spot is bustling with activity, from joggers and walkers to street vendors
                        and fishermen. As you cycle along the Corniche, you'll pass by iconic landmarks such as the
                        Pigeon Rocks and the historic Manara Lighthouse. The area is also dotted with cafes and
                        restaurants where you can take a break and enjoy local delicacies. Cycling in Beirut not only
                        offers a great workout but also a unique way to experience the city's dynamic atmosphere and
                        stunning coastal views.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/skiing-faraya.jpg" alt="Skiing in Faraya">
                    <div class="news-summary">
                        <h2>Skiing in Faraya</h2>
                        <div class="news-date">Published on: January 25, 2024</div>
                        <p>Faraya is a popular skiing destination in Lebanon, known for its snowy slopes and excellent
                            facilities. Skiers and snowboarders...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>Faraya is a popular skiing destination in Lebanon, known for its snowy slopes and excellent
                        facilities. Skiers and snowboarders of all levels can enjoy the winter sports and the stunning
                        mountain views. The Mzaar-Kfardebian ski resort, the largest in the region, offers a variety of
                        slopes, from gentle beginner trails to challenging runs for advanced skiers. The resort also
                        features modern amenities, including equipment rentals, ski schools, and cozy lodges where you
                        can relax after a day on the slopes. Beyond skiing, Faraya's winter landscape provides
                        opportunities for snowshoeing, sledding, and other snow activities. The picturesque mountain
                        scenery, combined with the thrill of winter sports, makes Faraya a must-visit destination for
                        outdoor enthusiasts in Lebanon.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/horseback-riding-jbeil.jpg" alt="Horseback Riding in Jbeil">
                    <div class="news-summary">
                        <h2>Horseback Riding in Jbeil</h2>
                        <div class="news-date">Published on: February 1, 2024</div>
                        <p>Explore the scenic beauty of Jbeil while horseback riding through lush landscapes and
                            historical sites...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>Explore the scenic beauty of Jbeil while horseback riding through lush landscapes and historical
                        sites. Jbeil, also known as Byblos, is a historic city with beautiful countryside perfect for
                        horseback riding. Guided tours are available, offering a unique way to experience the area’s
                        ancient ruins and natural beauty. Riders can traverse gentle trails, view ancient ruins, and
                        enjoy the serenity of the surrounding landscape. Whether you’re a seasoned equestrian or a
                        beginner, horseback riding in Jbeil provides a memorable experience that combines adventure with
                        history.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/kayaking-bekaa.jpg" alt="Kayaking in Bekaa Valley">
                    <div class="news-summary">
                        <h2>Kayaking in Bekaa Valley</h2>
                        <div class="news-date">Published on: February 5, 2024</div>
                        <p>Kayak through the picturesque rivers of Bekaa Valley, enjoying tranquil waters and scenic
                            views...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>Kayak through the picturesque rivers of Bekaa Valley, enjoying tranquil waters and scenic views
                        as you paddle through the region's natural beauty. The calm rivers are ideal for both beginners
                        and experienced kayakers, providing a peaceful escape from the hustle and bustle of city life.
                        The surrounding landscapes feature rolling hills and lush vegetation, adding to the overall
                        experience. Several local operators offer kayak rentals and guided tours, ensuring a safe and
                        enjoyable adventure on the water. Whether you're looking for a relaxing outing or a bit of
                        excitement, kayaking in the Bekaa Valley provides a memorable outdoor experience.</p>
                </div>
            </div>
            <div class="news-item">
                <div class="news-content">
                    <img src="Images/rock-climbing-kfardebian.jpg" alt="Rock Climbing in Kfardebian">
                    <div class="news-summary">
                        <h2>Rock Climbing in Kfardebian</h2>
                        <div class="news-date">Published on: February 15, 2024</div>
                        <p>Kfardebian's rugged cliffs offer excellent rock climbing opportunities for both beginners and
                            experienced climbers...</p>
                    </div>
                </div>
                <div class="news-detail">
                    <p>Kfardebian's rugged cliffs offer excellent rock climbing opportunities for both beginners and
                        experienced climbers. The area's diverse rock formations and varying difficulty levels provide
                        challenges for climbers of all skill levels. With professional climbing schools and equipment
                        rental services available, Kfardebian is a great place to start or advance your climbing
                        journey. The panoramic views from the climbing routes are an added bonus, offering a rewarding
                        perspective on Lebanon's natural beauty. Whether you're looking for a thrilling adventure or a
                        new outdoor activity, rock climbing in Kfardebian delivers an exciting experience amidst
                        stunning landscapes.</p>
                </div>
            </div>
        </section>
    </div>

</body>

</html>