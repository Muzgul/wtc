# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile.sh                                        :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2017/06/10 12:18:15 by mmacdona          #+#    #+#              #
#    Updated: 2017/09/30 20:13:05 by mmacdona         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

NAME = libft.a
FLAGS = gcc -Wall -Werror -Wextra
SOURCES = ft_strsearch.c ft_lstadd.c ft_lstnew.c ft_putendl_fd.c ft_strmapi.c ft_strequ.c ft_bzero.c ft_strtrim.c ft_strnequ.c ft_strcat.c ft_putstr.c ft_isascii.c ft_strclr.c ft_strstr.c ft_memalloc.c ft_isalnum.c ft_strrchr.c ft_strncat.c ft_strnstr.c ft_isprint.c ft_putnbr_fd.c ft_putendl.c ft_strcmp.c ft_strchr.c ft_strsplit.c ft_strncmp.c ft_tolower.c ft_putnbr.c ft_memcmp.c ft_memchr.c ft_atoi.c ft_memmove.c ft_putchar_fd.c ft_isspace.c ft_strspaces.c ft_isdigit.c ft_toupper.c ft_strjoin.c ft_memdel.c ft_strlen.c ft_strncpy.c ft_itoa.c ft_putstr_fd.c ft_memccpy.c ft_isalpha.c ft_strmap.c ft_memset.c ft_striter.c ft_strcpy.c ft_strdup.c ft_strsub.c ft_putchar.c ft_striteri.c ft_strdel.c ft_strlcat.c ft_memcpy.c ft_strnew.c 

OBJECTS = $(SOURCES:.c=.o)

all: $(NAME)

$(NAME): 
	@$(FLAGS) -c $(SOURCES)
	@ar rc $(NAME) $(OBJECTS)
	@ranlib $(NAME)
	

clean:
	@/bin/rm -f $(OBJECTS)

fclean: clean
	@/bin/rm -f $(NAME)

re: fclean all 
