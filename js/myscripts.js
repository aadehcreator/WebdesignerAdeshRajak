var typed = new Typed(".text", {
    strings: ["Frontend Developer", "Youtuber", "Web Developer"],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true
});


document.getElementById('contactForm').addEventListener('submit', async (e)=>{
      e.preventDefault();
      const data = {
          name: document.getElementById('name').value,
          email: document.getElementById('email').value,
          phone: document.getElementById('phone').value,
          message: document.getElementById('message').value
      };

      const res = await fetch('http://localhost/portfolio/api/contact.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(data)
      });
      const json = await res.json();
      document.getElementById('result').innerText = json.message;
  });