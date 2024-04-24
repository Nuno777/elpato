/* var express = require('express');
//var path = require('path');

const PORT = process.env.PORT || 10000;

var app = express();
app.use(express.json({ limit: '3MB' }))
app.use(express.urlencoded({ extended: true }));
app.use(express.static(__dirname + '/public'));



app.get('/', async (req, res, next) => {
  res.sendFile(__dirname + "/public/index.html");
})

app.get('*', async (req, res, next) => {
  res.sendFile(__dirname + "/public/404.html");
})


async function validateRecaptcha(token) {
  try {
    const response = await axios.post(`https://www.google.com/recaptcha/api/siteverify?secret=${RECAPTCHA_API_KEY}&response=${token}`);
    return response.data.success;
  } catch (error) {
    console.error(error);
    return false;
  }
}

// Substitua RECAPTCHA_API_KEY pela sua chave secreta do Recaptcha
const RECAPTCHA_API_KEY = '6Ld-9cUpAAAAADaFH2qUEjXt16O83Z-WIqowmwR5';

// Exemplo de uso:
const token = '6Ld-9cUpAAAAAJcj6xS1d848ERpRSOFIgOPTLpQA';
validateRecaptcha(token)
  .then(isValid => {
    if (isValid) {
      console.log('Recaptcha válido');
    } else {
      console.log('Recaptcha inválido');
    }
  })
  .catch(error => {
    console.error('Erro ao validar Recaptcha:', error);
  });

app.listen(PORT/*,()=>console.log('http://localhost:8050'));
 */

var express = require('express');

const PORT = process.env.PORT || 10000;

var app = express();
app.use(express.json({ limit: '3MB' }))
app.use(express.urlencoded({ extended: true }));
app.use(express.static(__dirname + '/public'));

// Substitua RECAPTCHA_API_KEY pela sua chave secreta do Recaptcha
const RECAPTCHA_API_KEY = '6Lf-_8UpAAAAAGek0dAQDEFiZbzGmc0znnx0BUb-';

app.post('/submit-form', async (req, res) => {
  const token = req.body.recaptchaToken;

  // Valida o token do reCAPTCHA
  try {
    const response = await axios.post(`https://www.google.com/recaptcha/api/siteverify?secret=${RECAPTCHA_SECRET_KEY}&response=${token}`);
    const isValid = response.data.success;

    if (isValid) {
      // O reCAPTCHA é válido, continue processando os dados do formulário aqui
      res.send('Formulário enviado com sucesso!');
    } else {
      // O reCAPTCHA falhou, retorne uma resposta de erro adequada
      res.status(400).send('Falha na validação do reCAPTCHA');
    }
  } catch (error) {
    console.error('Erro ao validar reCAPTCHA:', error);
    res.status(500).send('Erro interno ao processar o reCAPTCHA');
  }
});

app.get('/', async (req, res, next) => {
  res.sendFile(__dirname + "/public/index");
})

app.listen(PORT, () => {
  console.log(`Servidor rodando na porta ${PORT}`);
});
