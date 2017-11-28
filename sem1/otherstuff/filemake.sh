#!/bin/bash
printf "# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile.sh                                        :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: mmacdona <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2017/06/10 12:18:15 by mmacdona          #+#    #+#              #
#    Updated: 2017/06/10 13:59:30 by mmacdona         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

NAME = libft.a
FLAGS = gcc -Wall -Werror -Wextra
SOURCES = " > Makefile
find . -type f | grep "\.c$" | cut -c 3- | tr "\n" " " | cut -c 1- | cat >> Makefile
echo '
OBJECTS = $(SOURCES:.c=.o)

$(OBJECTS): $(SOURCES)
	$(FLAGS) -c $(SOURCES)

$(NAME): $(OBJECTS)
	ar rc $(NAME) $(OBJECTS)
	ranlib $(NAME)

all: $(NAME)

clean:
	/bin/rm -f $(OBJECTS)

fclean: clean
	/bin/rm -f $(NAME)

re: fclean all ' >> Makefile
