# Interesting Histories — Summary

Laravel app for short stories with moderation, tags, likes/comments, chats, and admin user management.

---

## Public

| Path | Method | Name | What it does |
|------|--------|------|--------------|
| `/` | GET | `index` | Feed of published posts |
| `/posts` | GET | `posts.index` | Same (alias) |
| `/changelog` | GET | `changelog` | Changelog |
| `/up` | GET | — | Health check |

---

## Auth (guest / auth)

| Path | Method | Name |
|------|--------|------|
| `/register` | GET/POST | `register` |
| `/login` | GET/POST | `login` |
| `/forgot-password` | GET/POST | `password.request` / `password.email` |
| `/reset-password/{token}` | GET | `password.reset` |
| `/reset-password` | POST | `password.store` |
| `/verify-email` | GET | `verification.notice` |
| `/verify-email/{id}/{hash}` | GET | `verification.verify` |
| `/email/verification-notification` | POST | `verification.send` |
| `/confirm-password` | GET/POST | `password.confirm` |
| `/password` | PUT | `password.update` |
| `/logout` | POST | `logout` |

---

## Profile (auth)

| Path | Method | Name | Functionality |
|------|--------|------|---------------|
| `/profile` | GET | `profile.edit` | Edit profile |
| `/profile` | PATCH | `profile.update` | Update profile |
| `/profile` | DELETE | `profile.destroy` | Delete account |

---

## Posts (auth)

| Path | Method | Name | Functionality |
|------|--------|------|---------------|
| `/posts/my` | GET | `posts.my` | My stories (+ search) |
| `/posts/add` | GET | `posts.add` | Create form |
| `/posts/create` | POST | `posts.create` | Create (draft / pending) |
| `/posts/statusChange` | POST | `posts.statusChange` | Change status |
| `/posts/delete` | DELETE | `posts.delete` | Delete |
| `/posts/requests` | GET/POST | `posts.requests` | Moderation queue (`pending`) |
| `/posts/{id}` | GET | `posts.detail` | Post detail |
| `/posts/like/{id}` | POST | `posts.like` | Like / unlike |
| `/posts/comment/{id}` | POST | `posts.comment` | Add comment |

**Post statuses:** `draft` → `pending` → `published` / `rejected`

**Limits:** title ≤ 70, text ≤ 700

---

## Tags (auth + can create Tag)

| Path | Method | Name |
|------|--------|------|
| `/tags` | GET | `tags.all` |
| `/tags/create` | POST | `tags.create` |
| `/tags/{tag}` | DELETE | `tags.delete` |

---

## Users (auth + can viewAny User)

| Path | Method | Name | Functionality |
|------|--------|------|---------------|
| `/users` | GET | `users.index` | Search / manage |
| `/users/{user}` | GET | `users.view` | User profile |
| `/users/ban/{user}` | POST | `users.ban` | Ban (+ force logout) |
| `/users/mute/{user}` | POST | `users.mute` | Mute |

---

## Chats (auth)

| Path | Method | Name | Functionality |
|------|--------|------|---------------|
| `/chats` | GET | `chats.viewAny` | Chat list |
| `/chats/create` | POST | `chats.create` | Create chat (with `user_id`) |
| `/chats/{chat}` | GET | `chats.view` | Open chat |
| `/chats/{chat}/message` | POST | `chats.message` | Send message (+ broadcast) |

**Broadcast channels:** `App.Models.User.{id}`, `channel_for_everyone` (Reverb)

---

## Feature blocks

1. **Stories** — CRUD, tags, pagination, draft/pending/publish/reject flow
2. **Social** — like toggle, comments
3. **Admin** — tags, users (ban/mute), publish requests; roles `admin` / `main_admin`
4. **Chats** — 1-1 chats, realtime via jobs/events
5. **Profile** — Breeze-style edit / update / destroy
6. **i18n** — `lang/ru`, `lang/en`
