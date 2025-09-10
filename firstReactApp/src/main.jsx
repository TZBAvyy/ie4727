import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import FormValidationExample from './FormValidationExample.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <FormValidationExample/>
  </StrictMode>,
)
