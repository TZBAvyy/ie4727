import { BrowserRouter, Routes, Route, Link } from 'react-router-dom'
import Home from './routes/Home.jsx'
import Music from './routes/Music.jsx'
import Menu from './routes/Menu.jsx'
import Jobs from './routes/Jobs.jsx'
import './App.css'

function App() {

  return (
    <BrowserRouter>
    <div className="container">
      {/* HEADER ZONE */}
        <header className="header">
            <h1>JavaJam Coffee House</h1>
        </header>

        <nav id="left-col">
            <div className="nav-links">
                <Link to="/">Home</Link>
                <Link to="/menu">Menu</Link>
                <Link to="/music">Music</Link>
                <Link to="/jobs">Jobs</Link>
            </div>
        </nav>

      {/* CONTENT ZONE */}
      <div className="content">
        <Routes>
          <Route exact path="/" element={<Home/>} />
          <Route path="/music" element={<Music/>} />
          <Route path="/menu" element={<Menu/>} />
          <Route path="/jobs" element={<Jobs/>} />
        </Routes>
      </div>

      {/* FOOTER ZONE */}
      <footer className="footer">
        <small>
            <i>
                Copyright &copy; 2014 JavaJam Coffee House<br/>
            </i>
        </small>
        <small>
            <i>
                <a href="mailto:avisena@gibraltar.com">
                    avisena@gibraltar.com
                </a>
            </i>
        </small>
      </footer>
     </div>
    </BrowserRouter>
  )
}

export default App
