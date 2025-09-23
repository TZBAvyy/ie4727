import { BrowserRouter, Routes, Route, Link } from 'react-router-dom'
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
                <Link to="/">Home</Link>
                <Link to="/menu">Menu</Link>
                <Link to="/music">Music</Link>
                <Link to="/jobs">Jobs</Link>
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
