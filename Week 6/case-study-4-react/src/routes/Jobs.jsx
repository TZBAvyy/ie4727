import { useState } from 'react';
import './Jobs.css'

const Jobs = () => {
    let [name, setName] = useState("");
    let [email, setEmail] = useState("");
    let [date, setDate] = useState("");
    let [exp, setExp] = useState("");

    function handleSubmit(e) {
        const name_exp = /^[A-Z][a-z]+ [A-Z][a-z]+/;
        const email_exp = /^[\w.-]+@(\w+\.){1,3}\w{2,3}$/;

        if (exp == "") {
            alert("Please do not leave your experience blank");
            e.preventDefault();
            return;
        }

        const regexValid = name_exp.test(name) && email_exp.test(email);

        if (!regexValid) {
            alert("Please enter a valid name and/or email");
            e.preventDefault();
            return;
        }

        if (date != "") {
            let currentDate = new Date();
            let inputDate = new Date(date);
            currentDate.setHours(0,0,0,0);
            inputDate.setHours(0,0,0,0);

            if (inputDate <= currentDate) {
                alert("Please enter a start date in the future");
                e.preventDefault();
                return;
            }  
        }
    }

    function handleClear(e) {
        e.preventDefault();
        setName("");
        setEmail("");
        setDate("");
        setExp("");
    }

    return (
<>
    <h2>Jobs at JavaJam</h2>
    <p>Want to work at JavaJam? Fill out the form below to start your application. Required fields are marked with an asterisk *</p>

    <form action="/show_post.php" method="post" id="form">
        <div className="form-item">
            <label for="name">*Name:</label><br/>
            <input 
            type="text" 
            id="name" 
            name="name" 
            required 
            placeholder="Enter your name here"
            value={name}
            onChange={(e) => {setName(e.target.value)}}
            /><br/><br/>
        </div>

        <div className="form-item">
            <label for="email">*Email:</label><br/>
            <input 
            type="email" 
            id="email" 
            name="email" 
            required 
            placeholder="Enter your Email-ID here"
            value={email}
            onChange={(e) => {setEmail(e.target.value)}}
            /><br/><br/>
        </div>

        <div className="form-item">
            <label for="date">Start Date:</label><br/>
            <input type="date" id="date" name="date" value={date} onChange={(e) => {setDate(e.target.value)}}
/><br/><br/>
        </div>

        <div className="form-item">
            <label for="experience">*Experience:</label><br/>
            <textarea id="experience" name="experience" rows="4" cols="50" required placeholder="Enter your past experience here" onChange={(e) => {setExp(e.target.value)}} value={exp}></textarea><br/><br/>
        </div>

        <button onClick={handleClear}>Clear</button><br/><br/>
        <input type="submit" value="Apply Now" onClick={handleSubmit}/>
    </form>
</>
    )
    
}

export default Jobs;