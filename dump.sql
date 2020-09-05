--
-- PostgreSQL database dump
--

-- Dumped from database version 11.8
-- Dumped by pg_dump version 12.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.admin (id, username, roles, password) FROM stdin;
104	admin	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$VDOqT0GYGcJ+rad2OwAgeg$yoEQ8R4Ss9syYWuAnRx6AdQldNFuTzNzC1BExteh2Jo
\.


--
-- Data for Name: conference; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.conference (id, city, year, is_international, slug) FROM stdin;
210	Amsterdam	2019	t	amsterdam-2019
211	Paris	2020	f	paris-2020
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.comment (id, conference_id, author, text, email, created_at, photo_filename, state) FROM stdin;
200	210	Fabien	This was a great conference.	fabien@example.com	2020-08-03 07:12:35	\N	published
201	210	Lucas	I think this one is going to be moderated.	lucas@example.com	2020-08-03 07:12:35	\N	submitted
202	210	Fabien	Some feedback from an automated functional test	me@automat.ed	2020-08-03 07:12:38	7f9fcc87abf2.gif	submitted
203	210	asdsa	asdsadasd	akismet-guaranteed-spam@example.com	2020-08-03 07:32:50	\N	published
204	211	saadad	asdsada sad sad ;;	akismet-guaranteed-spam@example.com	2020-08-03 07:35:28	\N	published
205	211	sdsad	spa,m	akismet-guaranteed-spam@example.com	2020-08-03 07:35:58	\N	spam
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20200701220040	2020-07-08 09:52:30	74
DoctrineMigrations\\Version20200709214729	2020-07-09 21:49:50	77
DoctrineMigrations\\Version20200709215111	2020-07-09 21:51:20	77
DoctrineMigrations\\Version20200714144959	2020-07-14 14:50:21	153
DoctrineMigrations\\Version20200803070236	2020-08-03 07:04:14	105
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.admin_id_seq', 104, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.comment_id_seq', 205, true);


--
-- Name: conference_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.conference_id_seq', 211, true);


--
-- PostgreSQL database dump complete
--

