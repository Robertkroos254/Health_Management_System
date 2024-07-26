document.addEventListener('DOMContentLoaded', function() {
    const dashboardIcon = document.getElementById('dashboard-icon');
    let iconContainerLoaded = false;
    let iconContainer;

    dashboardIcon.addEventListener('click', function(e) {
        e.preventDefault();

        if (!iconContainerLoaded) {
            // Create the icon container
            iconContainer = document.createElement('div');
            iconContainer.innerHTML = `
                <style>
                    #icon-container {
                        display: none;
                        position: absolute;
                        top: 40px;
                        right: 10%;
                        background-color: #f0f0f0;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    }
                    .icon-container {
                        display: grid;
                        grid-template-columns: 1fr;
                        gap: 10px;
                    }
                    .icon-item {
                        display: flex;
                        align-items: center;
                    }
                    .icon-item img {
                        height: 30px;
                        width: auto;
                        margin-right: 10px;
                    }
                    .icon-item span {
                        font-size: 14px;
                    }
                </style>
                <div id="icon-container">
                    <div class="icon-container">
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="MCH Icon">
                            <span><a href="nbu.html">NBU</a></span>
                        </div>
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="Anti-natal Icon">
                            <span><a href="antinato.html">Ante-Natal</a></span>
                        </div>
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="Post-natal Icon">
                            <span><a href="postnato.html">Post-Natal</a></span>
                        </div>
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="Female Ward Icon">
                            <span>Female Ward</span>
                        </div>
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="Male Ward Icon">
                            <span>Male Ward</span>
                        </div>
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="Male Ward Icon">
                            <span>Casualty</span>
                        </div>
                        <div class="icon-item">
                            <img src="./icons/dashboard.png" alt="Male Ward Icon">
                            <span>Paediactric</span>
                        </div>
                    </div>
                </div>
            `;

            // Append the icon container to the body
            document.body.appendChild(iconContainer);
            iconContainerLoaded = true;
        }

        // Toggle the visibility of the icon container
        const iconContainerElement = document.getElementById('icon-container');
        if (iconContainerElement) {
            iconContainerElement.style.display = iconContainerElement.style.display === 'none' ? 'block' : 'none';
        }
    });

    // Close the icon container when clicking outside of it
    document.addEventListener('click', function(e) {
        if (iconContainerLoaded && iconContainer && !iconContainer.contains(e.target) && e.target !== dashboardIcon) {
            const iconContainerElement = document.getElementById('icon-container');
            if (iconContainerElement) {
                iconContainerElement.style.display = 'none';
            }
        }
    });
});