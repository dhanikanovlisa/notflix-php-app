--
-- PostgreSQL database dump
--

-- Dumped from database version 16.0 (Debian 16.0-1.pgdg120+1)
-- Dumped by pg_dump version 16.0 (Debian 16.0-1.pgdg120+1)

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

SET default_table_access_method = heap;

--
-- Name: film; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.film (
    film_id integer NOT NULL,
    title character varying(256) NOT NULL,
    description text,
    film_path character varying(256) NOT NULL,
    film_poster character varying(256) NOT NULL,
    film_header character varying(256) NOT NULL,
    date_release date NOT NULL,
    duration integer NOT NULL
);


ALTER TABLE public.film OWNER TO postgres;

--
-- Name: film_film_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.film_film_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.film_film_id_seq OWNER TO postgres;

--
-- Name: film_film_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.film_film_id_seq OWNED BY public.film.film_id;


--
-- Name: film_genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.film_genre (
    film_id integer,
    genre_id integer
);


ALTER TABLE public.film_genre OWNER TO postgres;

--
-- Name: genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.genre (
    genre_id integer NOT NULL,
    name character varying(256) NOT NULL
);


ALTER TABLE public.genre OWNER TO postgres;

--
-- Name: genre_genre_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.genre_genre_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.genre_genre_id_seq OWNER TO postgres;

--
-- Name: genre_genre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.genre_genre_id_seq OWNED BY public.genre.genre_id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    username character varying(128) NOT NULL,
    first_name character varying(128) NOT NULL,
    last_name character varying(128) NOT NULL,
    email character varying(128) NOT NULL,
    password character varying(256) NOT NULL,
    phone_number character varying(30) NOT NULL,
    photo_profile character varying(256),
    is_admin boolean NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_user_id_seq OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- Name: watchlist; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.watchlist (
    user_id integer,
    film_id integer
);


ALTER TABLE public.watchlist OWNER TO postgres;

--
-- Name: film film_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.film ALTER COLUMN film_id SET DEFAULT nextval('public.film_film_id_seq'::regclass);


--
-- Name: genre genre_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre ALTER COLUMN genre_id SET DEFAULT nextval('public.genre_genre_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- Data for Name: film; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.film (film_id, title, description, film_path, film_poster, film_header, date_release, duration) FROM stdin;
1	Fast X	Over many missions and against impossible odds, Dom Toretto and his family have outsmarted, out-nerved and outdriven every foe in their path. Now, they confront the most lethal opponent theyve ever faced: A terrifying threat emerging from the shadows of the past who s fueled by blood revenge, and who is determined to shatter this family and destroy everything—and everyone—that Dom loves, forever.	film1.mp4	film1_poster.jpg	film1_header.jpg	2023-05-19	142
2	Mission: Impossible - Dead Reckoning Part One	Ethan Hunt and his IMF team embark on their most dangerous mission yet: To track down a terrifying new weapon that threatens all of humanity before it falls into the wrong hands. With control of the future and the world s fate at stake and dark forces from Ethan s past closing in, a deadly race around the globe begins.	film2.mp4	film2_poster.jpg	film2_header.jpg	2023-07-12	164
3	The Flash	When his attempt to save his family inadvertently alters the future, Barry Allen becomes trapped in a reality in which General Zod has returned and there are no Super Heroes to turn to. In order to save the world that he is in and return to the future that he knows, Barry s only hope is to race for his life. But will making the ultimate sacrifice be enough to reset the universe?	film3.mp4	film3_poster.jpg	film3_header.jpg	2023-06-14	144
4	The Meg 2: The Trench	An exploratory dive into the deepest depths of the ocean of a daring research team spirals into chaos when a malevolent mining operation threatens their mission and forces them into a high-stakes battle for survival.	film4.mp4	film4_poster.jpg	film4_header.jpg	2023-08-14	116
5	The Equalizer 2	Robert McCall serves an unflinching justice for the exploited and oppressed, but how far will he go when that is someone he loves?	film5.mp4	film5_poster.jpg	film5_header.jpg	2022-08-18	121
6	Barbie	A doll living in Barbieland is expelled for not being perfect enough and sets off on an adventure in the real world. A Live-action feature film based on the popular line of Barbie toys.	film6.mp4	film6_poster.jpg	film6_header.jpg	2023-06-30	120
7	Elemental	After a childhood accident, college student Addie is plagued by guilt and doubts. After meeting a mysterious stranger in the forest, she unearths supernatural abilities that she can t explain. And with her life on the line, she must harness these powers to uncover the truth about her past and the sinister forces conspiring against her.	film7.mp4	film7_poster.jpg	film7_header.jpg	2023-04-20	110
8	The Little Mermaid	A young mermaid gives up her life in the sea to be with the man she loves.	film8.mp4	film8_poster.jpg	film8_header.jpg	2023-07-21	109
9	Coco	Aspiring musician Miguel, confronted with his family s ancestral ban on music, enters the Land of the Dead to find his great-great-grandfather, a legendary singer.	film9.mp4	film9_poster.jpg	film9_header.jpg	2017-11-22	105
10	Doctor Strange in the Multiverse of Madness	After the events of Avengers: Endgame, Dr. Stephen Strange continues his research on the Time Stone. But an old friend turned enemy seeks to destroy every sorcerer on Earth, messing with Strange s plan and also causing him to unleash an unspeakable evil.	film10.mp4	film10_poster.jpg	film10_header.jpg	2022-05-06	150
11	Shang-Chi and the Legend of the Ten Rings	Shang-Chi, the master of unarmed weaponry-based Kung Fu, is forced to confront his past after being drawn into the Ten Rings organization.	film11.mp4	film11_poster.jpg	film11_header.jpg	2021-09-03	132
12	Oppenheimer	A look at the life and work of the influential physicist Albert Einstein.	film12.mp4	film12_poster.jpg	film12_header.jpg	2023-12-31	160
13	Interstellar	A team of explorers travel through a wormhole in space in an attempt to ensure humanity s survival.	film13.mp4	film13_poster.jpg	film13_header.jpg	2014-11-07	169
14	Me Before You	A girl in a small town forms an unlikely bond with a recently-paralyzed man she s taking care of.	film14.mp4	film14_poster.jpg	film14_header.jpg	2016-06-03	110
15	Cinderella	A modern movie musical with a bold take on the classic fairy tale. Our ambitious heroine has big dreams and with the help of her fab Godmother, she perseveres to make them come true.	film15.mp4	film15_poster.jpg	film15_header.jpg	2021-09-03	113
16	Parasite	Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.	film16.mp4	film16_poster.jpg	film16_header.jpg	2019-10-11	132
17	A Haunting in Venice	A group of friends are terrorized by a vengeful spirit who uses her deadly Black Rose touch to kill them one by one.	film17.mp4	film17_poster.jpg	film17_header.jpg	2023-10-27	98
18	Gone Girl	With his wife s disappearance having become the focus of an intense media circus, a man sees the spotlight turned on him when it s suspected that he may not be innocent.	film18.mp4	film18_poster.jpg	film18_header.jpg	2014-10-03	149
19	Glass Onion: A Knives Out Mystery	A detective and her partner investigate the death of a wealthy patriarch, but they soon discover a web of lies and secrets that lead them down a twisted path.	film19.mp4	film19_poster.jpg	film19_header.jpg	2023-09-15	125
20	Knives Out	A detective investigates the death of a patriarch of an eccentric, combative family.	film20.mp4	film20_poster.jpg	film20_header.jpg	2019-11-27	131
\.


--
-- Data for Name: film_genre; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.film_genre (film_id, genre_id) FROM stdin;
\.


--
-- Data for Name: genre; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.genre (genre_id, name) FROM stdin;
1	Action
2	Fantasy
3	Drama
4	Mystery
5	Comedy
6	Science Fiction
7	Romance
8	Thriller
9	Horror
10	Adventure
11	Crime
12	Animation
13	Family
14	Documentary
15	Biography
16	History
17	War
18	Musical
19	Sport
20	Western
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (user_id, username, first_name, last_name, email, password, phone_number, photo_profile, is_admin) FROM stdin;
1	admin	Jane	Smith	jane.smith@example.com	$2y$10$wP7/urYq5YUMTTk3dhgenOLJtIZlEAcHl8u0h5szZGxAoxZi1iHBu	+9876543210	profile1.jpg	t
2	user	John	Doe	john.doe@example.com	$2y$10$wP7/urYq5YUMTTk3dhgenOLJtIZlEAcHl8u0h5szZGxAoxZi1iHBu	+1234567890	profile2.jpg	f
\.


--
-- Data for Name: watchlist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.watchlist (user_id, film_id) FROM stdin;
\.


--
-- Name: film_film_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.film_film_id_seq', 20, true);


--
-- Name: genre_genre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.genre_genre_id_seq', 20, true);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_user_id_seq', 3, true);


--
-- Name: film film_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.film
    ADD CONSTRAINT film_pkey PRIMARY KEY (film_id);


--
-- Name: genre genre_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre
    ADD CONSTRAINT genre_name_key UNIQUE (name);


--
-- Name: genre genre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.genre
    ADD CONSTRAINT genre_pkey PRIMARY KEY (genre_id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: watchlist fk_film; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.watchlist
    ADD CONSTRAINT fk_film FOREIGN KEY (film_id) REFERENCES public.film(film_id);


--
-- Name: film_genre fk_film_genre_film; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.film_genre
    ADD CONSTRAINT fk_film_genre_film FOREIGN KEY (film_id) REFERENCES public.film(film_id);


--
-- Name: film_genre fk_film_genre_genre; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.film_genre
    ADD CONSTRAINT fk_film_genre_genre FOREIGN KEY (genre_id) REFERENCES public.genre(genre_id);


--
-- Name: watchlist fk_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.watchlist
    ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- PostgreSQL database dump complete
--

