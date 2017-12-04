/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   libft.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2017/09/11 17:16:48 by mmacdona          #+#    #+#             */
/*   Updated: 2017/09/28 17:49:31 by mmacdona         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LIBFT_H
# define FT_LIBFT_H
# include <string.h>
# include <stdlib.h>
# include <unistd.h>
# include <stdarg.h>

typedef struct		s_list
{
	void			*content;
	size_t			content_size;
	struct s_list	*next;
}					t_list;

typedef struct		s_flist
{
	void			(*f)(va_list args);
	char			c;
	struct s_flist	*next;
}					t_flist;

int			ft_printf(const char * restrict format, ...);
t_flist		*ft_flist();
int			ft_atoi(const char *str);
void		ft_bzero(void *s, size_t n);
size_t		ft_findnext(char const *str, char c, size_t start);
int			ft_isalnum(int c);
int			ft_isalpha(int c);
int			ft_isascii(int c);
int			ft_isdigit(int c);
int			ft_isprint(int c);
int			ft_isspace(char c);
char		*ft_itoa(int n);
void		ft_lstadd(t_list **alst, t_list *new);
t_list		*ft_lstnew(void const *content, size_t content_size);
char		*ft_lst_to_str(t_list *begin_lst);
void		*ft_memalloc(size_t size);
void		*ft_memccpy(void *restrict dst, const void *restrict src, int c, size_t n);
void		*ft_memchr(const void *s, int c, size_t n);
int			ft_memcmp(const void *s1, const void *s2, size_t n);
void		*ft_memcpy(void *restrict dst, const void *restrict src, size_t n);
void		ft_memdel(void **ap);
void		*ft_memmove(void *dst, const void *src, size_t len);
void		*ft_memset(void *b, int c, size_t len);
void		ft_putchar(char s);
void		ft_putchar_fd(char c, int fd);
void		ft_putendl(char const *s);
void		ft_putendl_fd(char const *s, int fd);
void		ft_putnbr(int n);
void		ft_putnbr_fd(int n, int fd);
void		ft_putstr(char const *s);
void		ft_putstr_fd(char const *s, int fd);
char		*ft_strcat(char *restrict s1, const char *restrict s2);
char		*ft_strchr(const char *s, int c);
void		ft_strclr(char *s);
int			ft_strcmp(const char *s1, const char *s2);
char		*ft_strcpy(char *dst, const char *src);
void		ft_strdel(char **as);
char		*ft_strdup(const char *s1);
int			ft_strequ(char const *s1, char const *s2);
void		ft_striter(char *s, void (*f)(char *));
void		ft_striteri(char *s, void (*f)(unsigned int, char *));
char		*ft_strjoin(char const *s1, char const *s2);
size_t		ft_strlcat(char *restrict s1, const char *restrict s2, size_t size);
size_t		ft_strlen(const char *s);
char		*ft_strmap(char const *s, char (*f)	(char));
char		*ft_strmapi(char const *s, char (*f)	(unsigned int, char));
char		*ft_strncat(char *restrict s1, const char *restrict s2, size_t n);
int			ft_strncmp(const char *s1, const char *s2, size_t n);
char		*ft_strncpy(char *dst, const char *src, size_t len);
int			ft_strnequ(char const *s1, char const *s2, size_t n);
char		*ft_strnew(size_t size);
char		*ft_strnstr(const char *big, const char *little, size_t len);
char		*ft_strrchr(const char *s, int c);
char		**ft_strsplit(const char *s, char c);
int			ft_strsearch(const char *str, char c);
int			ft_strspaces(char *s);
char		*ft_strstr(const char *big, const char *little);
char		*ft_strsub(char const *s, unsigned int start, size_t len);
char		*ft_strtrim(char *s);
int			ft_tolower(int c);
int			ft_toupper(int c);
size_t		ft_words(char const *str, char d);

#endif
