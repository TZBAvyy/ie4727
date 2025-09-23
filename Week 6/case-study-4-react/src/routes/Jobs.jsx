// import './Jobs.css'
import RoadImage from '../assets/image.jpg'

const Jobs = () => {

    return (
<>
    <h2>Follow the Winding Road to JavaJam</h2>
    <div class="image-section">
        <img src={RoadImage} alt="Road Image" width="50%" />
        <div class="image-text">
            <ul class="item-list">
                <li>Specialty Coffee and Tea</li>
                <li>Bagels, Muffins, and Organic Snacks</li>
                <li>Music and Poetry Readings</li>
                <li>Open Mic Night Every Friday</li>
            </ul>
        </div>
    </div>  
</>
    )
    
}

export default Jobs;