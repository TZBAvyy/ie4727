import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Home from './routes/Home'
import './App.css'

function App() {

  return (
    <BrowserRouter>
    <div class="container">
      {/* HEADER ZONE */}
        <header class="header">
            <h1>JavaJam Coffee House</h1>
        </header>

        <nav id="left-col">
            <div class="nav-links">
                <a href="index.html">Home</a>
                <a href="menu.html">Menu</a>
                <a href="music.html">Music</a>
                <a href="jobs.html">Jobs</a>
            </div>
        </nav>

      {/* CONTENT ZONE */}
      <div class="content">
        <Routes>
          <Route exact path="/" element={<Home/>} />
        </Routes>
      </div>

      {/* FOOTER ZONE */}
      <footer class="footer">
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
