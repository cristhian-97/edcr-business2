/**
 * 7-7:18     18
 * 7:23-7:52  29
 * 7:58-9:01  1y3
 * 9:09-9:25  16
 * 9:29-10:32 1y3 
 *  
 *  categorias = tbrol. Ej: Dj (id, nombre, tipo, estado, imagen)
    tbclientes (codigo, rol) id del rol... 
    Areas de trabajo = tbcaracteristicasxrol (idRol, id, nombre, estado) Ej: revistas, bares, discos, activaciones btl,fiestas, corporativas
    Otros filtros se toman de tbclientes (rol, preciohora, preciodia) 
    tbhabilidades (id, descripción, estado y rol). Ej: Acaparar al cliente, fluidez al hablar
    tbtrabajosxusuario (id, usuario, trabajo), trabajo=Radio y podcast, expos, masivos..

    tbdeportes(id, descripcion y estado)
    tbequipo (id, descripción y estado). Ej: Drone, cámara, luz, efectos 
    tbgenerosmusicales (id, descripcion y estado). Ej: Charanga, electrónica, Beggae, Roots, Electro House, House, Todos los generos 
    tbidioma (id, descripcion y estado). Ej: Español, Inglés
    tbpaises (id, nombre, opcionales, estado). Ej Costa Rica, Panama
    tbmusica (id, descripcion, estado). Ej: Rock en Español, Rock en Inglés, Latino


Filtros en clientes
<!--sexo
edad
provincia
canton
distrito
consentimiento
altura
peso
condiciones
portada
estado
rol
tipo
idpais
orden
calificacion
pagado
disponibilidad
facturaelectronica
transporte
experiencia
color_ojos
direccion
grado_academico
medidas
calzado
cursos
sobre_mi
cabello
frenillos
tattos
idioma
uniforme
pasaporte
licencia
instPrincipal
instSecundario
compositor
miFuerte
demos
equipoPropio
luces
equipoSonido
generosMusicales
deportes
musica
equipoList
habilidades
drone
camaraAccion
tVehiculo
montaje
trabajosR
tLicencia
preciohora
preciodia
entrega
colorpelo
colorpiel-->
 * 
 *  Edecanes: Selecciona tu área de trabajo
                      Activaciones
                      Btl
                      Expos
                      Giras
                    Color de ojos
                    Dirección
                    Grado académico
                    Medidas
                    Calzado
                    Peso
                    Altura
                    Seleciona Tipo de cabello
                      Largo,corto,colocho,liso
                    ¿Tienes frenillo: si o no?
                    ¿Tienes Tattos?: Visible No
                    Selecciona un idioma: Español ingles
                    Uniforme: Salga, Si, Formal, Ejecutivo, Vestido, Gala, Host, No
                    Tienes Pasaporte: Si o No
                    Tienes Licencia: Si o NO
                    Deportes que practicas: Natación, Atletismo, Ciclismo, Crossfit, Gym, Fútbol,
                     Volleyball, Basketball, Golf, Yoga

                    Modelos de Fotografías: campañas de publicidad y anuncios de tv, casual,
                     cosméticos, formal e informal, host, lencería, revistas, ropa deportiva,
                      tienda virtual o física, trajes de baño, vestidos de novia y publicidad externa
                    Color de ojos
                    Medidas
                    calzado
                    Peso
                    Altura  
                    Seleciona Tipo de cabello
                      Largo,corto,colocho,liso
                    ¿Tienes frenillo: si o no?
                    Tattos si o no
                    idioma español ingles
                    Uniforme: Salga, Si, Formal, Ejecutivo, Vestido, Gala, Host, No
                    Tienes Pasaporte: Si o No
                    Tienes Licencia: Si o NO
                    Deportes que practicas: Natación, Atletismo, Ciclismo, Crossfit, Gym, Fútbol,
                     Volleyball, Basketball, Golf, Yoga

                    Modelos de Fitness:
                    Area de trabjo_ Edecan, embajadora de marca, eventos deportivos, menciones
                     y publicidad enredes, modelo de ropa deportiva, patrocinio de marca,
                      publicidad de ropa deportiva
                    Color de ojos
                    Medidas
                    calzado
                    Peso
                    Altura  
                    Seleciona Tipo de cabello
                      Largo,corto,colocho,liso
                    ¿Tienes frenillo: si o no?
                    Tattos si o no
                    idioma español ingles
                    Uniforme: Salga, Si, Formal, Ejecutivo, Vestido, Gala, Host, No
                    Tienes Pasaporte: Si o No
                    Tienes Licencia: Si o NO
                    Deportes que practicas: Natación, Atletismo, Ciclismo, Crossfit, Gym, Fútbol,
                     Volleyball, Basketball, Golf, Yoga  
                    

                    Influencers:
                    Area de trabjo: comerciales de tv, eventos corporativos, fotografías,
                     masivos, menciones y publicidad en las redes sociales,Radio y podcasts,
                     visita presencial
                    Generos que manejas: Drone, cámara, luz, efectos 


                    Músicos:
                    Area de trabajo: 15 años, anuncios, chivos, comerciales, conciertos , 
                     corporativos, fiestas, fiestas privadas, fotografía, jingles, locución,
                     menciones, publicidad
                    Generos que manejas: Rock en español, rock en ingles, latino, charanga,
                     regae, cumbia, romántico,old school,60, 70,80,90
                    compositor si o no
                    Fuerte ingles, español ambos  
                    
                    Dj´s:
                    Área de trabajo: fiestas, 15 años, Activaciones Btl, Anuncios, Bares,
                     Conciertos, Corporativas, Discos, Eventos Masivos, Fistas privadas,
                     Inauguraciones, Menciones, Pistas,Publicidad, Radio, Teloneros
                    Equipo propio: Propio o no
                    Luces SI o No
                    Equipo de sonido: Si o no
                    Género músical: Charanga, electrónica, Beggae, Roots, Electro House,
                       House, Todos los generos 

                    categorias= tbrol= Dj´s: id=6
                    Areas de trabajo=tbcaracteristicasxxrol: bares, discos, activacioens btl,fiestas, corporativas,
                    tbclientes tiene el id del rol
                    Los demás filtros se toman de tbcliente
                    Cada registro de tbcliente tiene un preciohora, preciodia 
                    tbdeportes = tabla de deportes id, descripcion y estado
                    tbequipo (id, descripción y estado)= Generos que manejas: Drone, cámara, luz, efectos 
                    tbgenerosmusicales (id, descripcion y estado) =Género músical: Charanga, electrónica, Beggae, Roots, Electro House,
                       House, Todos los generos 
                    tbhabilidades (id, descripción, estado y rol) :
                    tbidioma (id, descripcion y estado)
                    tbmusica (id, descripcion, estado)    
                    tbpaises (id, nombre, opcionales, estado)
                    tbserviciosxusuario (id, usuario, trabajo), trabajo=Radio y podcast, expos, masivos..

                    Presentadores:
                    Area de trabajo: 15 años, activaciones Btl, comerciales, corporativas,
                     eventos masivos, fiestas, fiestas privadas, fotografía, galas,
                     inauguraciones, menciones, publicidad interna y externa
                    Generos que maneja: drone, cámara, luz, efectos 


                    Productores audiovisuales:
                    Area de trabajo: Creador de contenido, edición, fiestas privadas y 
                     corporativos, videos musicales, videos para redes sociales, 
                     videos personalizados

                    Transporte:
                    Area de trabajo: Activacion Btl,  alquiler de equipo: Pisos, estructuras,
                     sonido, luces y pantallas, booking de artistas, convenciones, 
                     diseños: randrs, stands, eventos corporativos,eventos masivos,
                     giras,produccion de
                     eventos.
                    
                    Montaje:
                    

                    Promotoras:
                    Areas de trabajo: Activación btl, alquiler de equipo: Pisos, estructuras,
                     sonido, luces y pantallas, booking de artistas, convenciones, 
                     diseños: randrs, stands, eventos corporativos, giras, produccion de
                     eventos.
                    
                    Fotógrafos:
                    Área de trabajo: fiestas, 15 años, Bodas, Btl, Campañas de Publicidad,
                      Compromisos, conciertos, corporativos, estilo de vida, revistas,
                       sesiones, tiendas online


                    Producción de Podcast
                     Area de trabajo: Diseños de logos y covert art, diseño de sonido,
                      Edición y posProduccion, entrenamiento y consultoría, grabación,
                       hosting y distribución, musica y jingles, produccion de anunciones,
                       roduccion de audio trailers   
 * 
 * 
 * 	
codigo
nombre
correo
sexo
edad
provincia
canton
distrito
consentimiento
fecha_registro
modelo_tel
Modelo del teléfono
fabricante_tel
Fabricante teléfono
plataforma_tel
Plataforma (Sistema Operativo) teléfono
version_tel
Version del sistema operativo del teléfono
afiliado
contrasena
telefono
nacimiento
altura
peso
condiciones
portada
estado
rol
tipo
idpais
orden
calificacion
pagado
disponibilidad
facturaelectronica
transporte
experiencia
color_ojos
direccion
grado_academico
medidas
calzado
cursos
sobre_mi
cabello
frenillos
tattos
idioma
uniforme
pasaporte
licencia
instPrincipal
instSecundario
compositor
miFuerte
demos
equipoPropio
luces
equipoSonido
generosMusicales
deportes
musica
equipoList
habilidades
drone
camaraAccion
tVehiculo
montaje
trabajosR
tLicencia
preciohora
preciodia
entrega
colorpelo
colorpiel
 * 
 * 
 */