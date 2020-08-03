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

SET default_tablespace = '';

--
-- Name: admin; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    username character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL
);


ALTER TABLE public.admin OWNER TO main;

--
-- Name: admin_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.admin_id_seq OWNER TO main;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.comment (
    id integer NOT NULL,
    conference_id integer NOT NULL,
    author character varying(255) NOT NULL,
    text text NOT NULL,
    email character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL,
    photo_filename character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.comment OWNER TO main;

--
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.comment_id_seq OWNER TO main;

--
-- Name: conference; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.conference (
    id integer NOT NULL,
    city character varying(255) NOT NULL,
    year character varying(4) NOT NULL,
    is_international boolean NOT NULL,
    slug character varying(255) NOT NULL
);


ALTER TABLE public.conference OWNER TO main;

--
-- Name: conference_id_seq; Type: SEQUENCE; Schema: public; Owner: main
--

CREATE SEQUENCE public.conference_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.conference_id_seq OWNER TO main;

--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: main
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO main;

--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.admin (id, username, roles, password) FROM stdin;
1	admin	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$jfE52Av/oLSZpwK7lIcALQ$9g+SD1CDMSIezX5lha4hD+6lm1/K7R4Dyjv9Rv3q5cI
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.comment (id, conference_id, author, text, email, created_at, photo_filename) FROM stdin;
8	3	Algo	asdada	sadad@asdd	2015-01-01 00:00:00	\N
11	3	asdad	asad	asda@asda.com	2015-01-01 00:00:00	\N
12	3	asdad	asdadasasd	asda@asda.com	2015-01-01 00:00:00	\N
13	3	sdsad	Alalalago	asda@asda.com	2020-07-09 21:43:00	\N
14	4	asda	asdad@ldld.cd	adssa@asdas.cl	2020-07-13 10:35:27	\N
15	4	sda	asdad	adssa@asdas.cl	2020-07-13 10:37:56	\N
16	4	asdad	asdsadsa	adsad@adsad.cd	2020-07-13 10:38:11	\N
17	4	asda	adasdad	adsad@asdsa.cd	2020-07-13 10:39:26	\N
18	4	asda	asdad	adssa@asdas.cl	2020-07-13 10:40:19	\N
19	4	asd	asda	adssa@asdas.cl	2020-07-13 10:41:40	\N
20	4	me	Algo genial	user@test.com	2020-07-13 10:46:15	\N
21	4	picture	asdsadas	adsad@asdsa.cd	2020-07-13 10:55:30	0f99b1ca91e7.jpeg
22	4	asda	asdad	adssa@asdas.cl	2020-07-15 22:15:46	\N
23	4	Juan Bimba	This is not a Spam	nospamme@test.com	2020-07-15 22:16:18	\N
24	4	test key secret	test key secret	user@test.com	2020-07-15 22:17:17	\N
25	4	spammer	spam jejej	akismet-guaranteed-spam@example.com	2020-07-15 22:17:52	\N
26	4	asda	sfsaf	akismet-guaranteed-spam@example.com	2020-07-15 22:19:44	\N
27	4	adad	adasd	akismet-guaranteed-spam@example.com	2020-07-15 22:21:19	\N
28	4	asasd	dsfdsf	akismet-guaranteed-spam@example.com	2020-07-15 22:24:33	\N
29	4	asda	asdd	akismet-guaranteed-spam@example.com	2020-07-15 22:25:27	\N
30	4	sdf	sfsdf	akismet-guaranteed-spam@example.com	2020-07-15 22:27:04	\N
31	4	asda	ads	akismet-guaranteed-spam@example.com	2020-07-15 22:27:53	\N
32	4	asda	asdad	adssa@asdas.cl	2020-07-15 22:28:19	\N
33	4	asda	asdad	user@test.com	2020-07-15 22:29:31	\N
34	4	asd	asda	akismet-guaranteed-spam@example.com	2020-07-15 22:29:47	\N
35	4	asda	asdd	akismet-guaranteed-spam@example.com	2020-07-15 22:31:49	\N
36	4	spam	adas	akismet-guaranteed-spam@example.com	2020-07-15 22:32:46	\N
37	4	as	sdad	akismet-guaranteed-spam@example.com	2020-07-15 22:34:28	\N
38	4	asds	asdasd	akismet-guaranteed-spam@example.com	2020-07-15 22:35:22	\N
41	4	asadasd	asdadasd	akismet-guaranteed-spam@example.com	2020-07-15 22:36:37	\N
42	4	sdasd	asdsadasd	akismet-guaranteed-spam@example.com	2020-07-15 22:37:46	\N
47	4	ass	aasa	akismet-guaranteed-spam@example.com	2020-07-15 22:43:41	\N
48	4	sda	asdadad	richardrodriguez21@gmail.com	2020-07-15 23:26:52	\N
49	4	asdad	asdasd	richardrodriguez21@gmail.com	2020-07-15 23:32:44	\N
50	4	da	asdsad	richardrodriguez21@gmail.com	2020-07-15 23:33:51	\N
51	4	sadad	asdad	richardrodriguez21@gmail.com	2020-07-15 23:34:28	\N
52	4	as	sdadd	richardrodriguez21@gmail.com	2020-07-15 23:36:53	\N
53	4	sdad	sadasdasd	richardrodriguez21@gmail.com	2020-07-15 23:38:23	\N
54	4	asdadd	asdasdsa	richardrodriguez21@gmail.com	2020-07-15 23:39:18	\N
55	4	asdad	asdsad	richardrodriguez21@gmail.com	2020-07-15 23:40:44	\N
56	4	asdda	asdsaddad	richardrodriguez21@gmail.com	2020-07-15 23:41:56	\N
57	4	asdsad	asdad	akismet-guaranteed-spam@example.com	2020-07-15 23:42:41	\N
58	4	asdsad	asdsad	akismet-guaranteed-spam@example.com	2020-07-15 23:43:25	\N
59	4	sadsadsad	asdsadas	richardrodriguez21@gmail.com	2020-07-15 23:43:46	\N
60	4	saadad	asdada	richardrodriguez21@gmail.com	2020-07-15 23:44:08	\N
61	4	adsad	sdasd	algo@algo.cl	2020-07-15 23:52:30	\N
\.


--
-- Data for Name: conference; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.conference (id, city, year, is_international, slug) FROM stdin;
3	Barcelona	2020	t	barcelona-2020
4	Paris	2019	t	paris-2019
5	Milan	2021	t	milan-2021
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20200701220040	2020-07-08 09:52:30	74
DoctrineMigrations\\Version20200709214729	2020-07-09 21:49:50	77
DoctrineMigrations\\Version20200709215111	2020-07-09 21:51:20	77
DoctrineMigrations\\Version20200714144959	2020-07-14 14:50:21	153
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.admin_id_seq', 1, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.comment_id_seq', 61, true);


--
-- Name: conference_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.conference_id_seq', 5, true);


--
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id);


--
-- Name: comment comment_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (id);


--
-- Name: conference conference_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.conference
    ADD CONSTRAINT conference_pkey PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: idx_9474526c604b8382; Type: INDEX; Schema: public; Owner: main
--

CREATE INDEX idx_9474526c604b8382 ON public.comment USING btree (conference_id);


--
-- Name: uniq_880e0d76f85e0677; Type: INDEX; Schema: public; Owner: main
--

CREATE UNIQUE INDEX uniq_880e0d76f85e0677 ON public.admin USING btree (username);


--
-- Name: uniq_911533c8989d9b62; Type: INDEX; Schema: public; Owner: main
--

CREATE UNIQUE INDEX uniq_911533c8989d9b62 ON public.conference USING btree (slug);


--
-- Name: comment fk_9474526c604b8382; Type: FK CONSTRAINT; Schema: public; Owner: main
--

ALTER TABLE ONLY public.comment
    ADD CONSTRAINT fk_9474526c604b8382 FOREIGN KEY (conference_id) REFERENCES public.conference(id);


--
-- PostgreSQL database dump complete
--

