import './Music.css'
import Artist1 from '../assets/man.jpg'
import Artist2 from '../assets/man2.jpg'
import SadeMP3 from '../assets/sade-smooth-operator.mp3'
import BrunoMP3 from '../assets/bruno-grenade.mp3'

const Music = () => {

    return (
<>
    <h2>Music at JavaJam</h2>            
    <p>JavaJam Coffee House features live music every Friday night. Join us for an evening of great tunes and good vibes!</p>
    <table className="music-table">
        <tbody>
            <tr className="light-row">
                <td ><strong>JANUARY</strong></td>
            </tr>
            <tr>
                <td className="artist-row">
                    <img src={Artist1} width="100px" height="100px" alt="Artist" />
                    <div>
                        <p>Melanie Morris entertains with her melodic folk style</p>
                        <strong>CDs are available now!</strong>
                        <audio controls>
                            <source src={SadeMP3} type="audio/mpeg" />
                        </audio>
                    </div>
                </td>
            </tr>
            <tr className="light-row">
                <td ><strong>FEBRUARY</strong></td>
            </tr>
            <tr>
                <td className="artist-row">
                    <img src={Artist2} width="100px" height="100px" alt="Artist" />
                    <div>
                        <p>Tahoe Greg is back from his tour. New songs. New stories.</p>
                        <strong>CDs are available now!</strong>
                        <audio controls>
                            <source src={BrunoMP3} type="audio/mpeg" />
                        </audio>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</>
    )
    
}

export default Music;